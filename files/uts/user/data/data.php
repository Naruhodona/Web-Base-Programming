<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../styles/data.css">
</head>
<script>
function renderBarChart(canvasId, data) {
  var ctx = document.getElementById(canvasId).getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: data.categories,
      datasets: [{
        data: data.series,
        backgroundColor: 'rgb(91, 157, 218)'
      }]
    },
    options: {
    	legend : {
    		display : false
    	}
    }
	});
	// Clear previous chart
	if (typeof window.myCharts === 'undefined') {
    window.myCharts = [];
  }
  if (typeof window.myCharts[canvasId] !== 'undefined') {
    window.myCharts[canvasId].destroy();
  }

  window.myCharts[canvasId] = chart;
  // Clear canvas
  ctx.clearRect(0, 0, document.getElementById(canvasId).width, document.getElementById(canvasId).height);
}

function renderLineChart(canvasId, data) {
  var ctx = document.getElementById(canvasId).getContext('2d');
  if(canvasId === 'A4'){
  	var title = "Kentang";
  } else if(canvasId === 'B2'){
  	var title = "Cabe Rawit";
  } else if(canvasId === 'C7'){
  	var title = "Bawang Merah";
  } else if(canvasId === 'D9'){
  	var title = "Wortel";
  } else if(canvasId === 'A5'){
  	var title = "Astambul";
  } else if(canvasId === 'G7'){
  	var title = "Gambut";
  } else if(canvasId === 'R2'){
  	var title = "Rantau";
  } else if(canvasId === 'P10'){
  	var title = "Pelaihari";
  }
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.categories,
      datasets: [{
        data: data.series,
        fill: false,
        lineTension: 0,
        borderColor: 'rgba(0, 0, 0, 0.5)'
      }]
    },
    options: {
    	legend : {
    		display : false
    	},
    	title : {
    		display : true,
    		text : title
    	}
    }
	});
	// Clear previous chart
	if (typeof window.myCharts === 'undefined') {
    window.myCharts = [];
  }
  if (typeof window.myCharts[canvasId] !== 'undefined') {
    window.myCharts[canvasId].destroy();
  }
  window.myCharts[canvasId] = chart;
  // Clear canvas
  ctx.clearRect(0, 0, document.getElementById(canvasId).width, document.getElementById(canvasId).height);
}
function submissionAjaxDaily(formId, url_, canvasId){
	$(formId).submit(function(e){ // Handle form submission using AJAX
			e.preventDefault(); // Prevent the form from submitting normally

			// Get the form data
			var formData = $(formId).serialize();

			$.ajax({
				type: 'POST',
				url: url_, // PHP script to handle form data
				data: formData,
				dataType: 'json',
				success: function(response){
					renderLineChart(canvasId, response[canvasId]);
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('AJAX Error: ' + textStatus + ': ' + errorThrown);
				}
			});
		});
}
function submissionAjaxMean(formId, url_, canvasId){
	$(formId).submit(function(e){ // Handle form submission using AJAX
			e.preventDefault(); // Prevent the form from submitting normally

			// Get the form data
			var formData = $(formId).serialize();

			$.ajax({
				type: 'POST',
				url: url_, // PHP script to handle form data
				data: formData,
				dataType: 'json',
				success: function(response){
					renderBarChart(canvasId, response);
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('AJAX Error: ' + textStatus + ': ' + errorThrown);
				}
			});
		});
}
function submissionAjaxChangeMean(formId, url_, tableId){
	$(formId).submit(function(e){ // Handle form submission using AJAX
			e.preventDefault(); // Prevent the form from submitting normally

			// Get the form data
			var formData = $(formId).serialize();

			$.ajax({
				type: 'POST',
				url: url_, // PHP script to handle form data
				data: formData,
				dataType: 'json',
				success: function(response){
					var table = document.getElementById(tableId);
					if(table.rows.length > 1){
						while(table.rows.length > 1){
							table.deleteRow(1);
						}
					}

					if(table.rows.length == 1){
						for (let i = 0; i < response['tanggal'].length; i++) {
							var row = table.insertRow();
						  var dateCell = row.insertCell();
						  var commodityCell = row.insertCell();
						  var priceCell = row.insertCell();
						  var meanCell = row.insertCell();

						  dateCell.innerHTML = response['tanggal'][i];
						  commodityCell.innerHTML = response['komoditas'][i];
							priceCell.innerHTML = response['harga'][i];
							meanCell.innerHTML = response['mean'][i];
						}
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('AJAX Error: ' + textStatus + ': ' + errorThrown);
				}
			});
		});
}

</script>
<body>
	<div class="header">
		<div class="logo">
        <img src="../../picture/logo.png" width="50%">
    </div>
    <div class="nav">
        <a href="../home.php"><div>Home</div></a>
        <a href="../komoditas/komoditas.php"><div>Komoditas</div></a>
        <a href="../pasar/pasar.php"><div>Pasar</div></a>
        <a href="data.php"><div style="color: black;">Data</div></a>
    </div>
	</div>
	<div class="content">
		<h2 style="text-align: center;">Perubahan harga rata-rata komoditas selama periode tertentu</h2>
		<form id="changeMean">
			<span><b>Mulai dari tanggal</b></span>
			<input type="date" name="startdate" min="2023-01-01" max="2023-12-31"> <b>sampai dengan tanggal</b>
			<input type="date" name="enddate" min="2023-01-01" max="2023-12-31"> <b>- Pasar : </b>
			<select id="kode_pasar" name="kode_pasar">
				<option value="A5">Astambul</option>
				<option value="G7">Gambut</option>
				<option value="R2">Rantau</option>
				<option value="P10">Pelaihari</option>
			</select>
			<button type="submit">Go</button>
		</form>
		<table border="1" id="changemean">
			<tr>
				<th>Tanggal</th>
				<th>Kode komoditas</th>
				<th>Harga</th>
				<th>Rata-rata perubahan harga</th>
			</tr>
		</table>
		<h2 style="text-align: center;">Harga harian tiap komoditas di pasar tertentu</h2>
		<form id="komoditasharian">
			<span><b>Mulai dari tanggal</b></span>
			<input type="date" name="startdate" min="2023-01-01" max="2023-12-31"> <b>sampai dengan tanggal</b>
			<input type="date" name="enddate" min="2023-01-01" max="2023-12-31"> <b>- Pasar : </b>
			<select id="kode_pasar" name="kode_pasar">
				<option value="A5">Astambul</option>
				<option value="G7">Gambut</option>
				<option value="R2">Rantau</option>
				<option value="P10">Pelaihari</option>
			</select>
			<button type="submit" id="dailyCommodity" name="dailyCommodity">Go</button>
		</form>
		<div class="daily-komoditas">
			<div>
				<canvas id="A4" style="width:100%;"></canvas>
			</div>
			<div>
				<canvas id="B2" style="width:100%;"></canvas>
			</div>
			<div>
				<canvas id="C7" style="width:100%;"></canvas>
			</div>
			<div>
				<canvas id="D9" style="width:100%;"></canvas>
			</div>
		</div>
		<h2 style="text-align: center;">Harga harian komoditas tertentu di tiap pasar</h2>
		<form id="pasarharian">
			<span><b>Mulai dari tanggal</b></span>
			<input type="date" name="startdate" min="2023-01-01" max="2023-12-31"> <b>sampai dengan tanggal</b>
			<input type="date" name="enddate" min="2023-01-01" max="2023-12-31"> <b>- Komoditas : </b>
			<select id="kode_komoditas" name="kode_komoditas">
				<option value="A4">Kentang</option>
				<option value="B2">Cabe Rawit</option>
				<option value="C7">Bawang Merah</option>
				<option value="D9">Wortel</option>
			</select>
			<button type="submit" id="dailyMarket" name="dailyMarket">Go</button>
		</form>
		<div class="daily-pasar">
			<div>
				<canvas id="A5" style="width:100%;max-width:700px"></canvas>
			</div>
			<div>
				<canvas id="G7" style="width:100%;max-width:700px"></canvas>
			</div>
			<div>
				<canvas id="R2" style="width:100%;max-width:700px"></canvas>
			</div>
			<div>
				<canvas id="P10" style="width:100%;max-width:700px"></canvas>
			</div>
		</div>
		<h2 style="text-align: center;">Harga rata-rata tiap komoditas di pasar tertentu</h2>
		<form id="komoditasmean">
			<span><b>Mulai dari tanggal</b></span>
			<input type="date" name="startdate" min="2023-01-01" max="2023-12-31"> <b>sampai dengan tanggal</b>
			<input type="date" name="enddate" min="2023-01-01" max="2023-12-31"> <b>- Pasar : </b>
			<select id="kode_pasar" name="kode_pasar">
				<option value="A5">Astambul</option>
				<option value="G7">Gambut</option>
				<option value="R2">Rantau</option>
				<option value="P10">Pelaihari</option>
			</select>
			<button type="submit" id="meanCommodity" name="meanCommodity">Go</button>
		</form>
		<div class="mean-komoditas">
			<div>
				<canvas id="mk" style="width:100%;max-width:700px"></canvas>
			</div>
		</div>
		<h2 style="text-align: center;">Harga rata-rata komoditas tertentu di tiap pasar.</h2>
		<form id="pasarmean">
			<span><b>Mulai dari tanggal</b></span>
			<input type="date" name="startdate" min="2023-01-01" max="2023-12-31"> <b>sampai dengan tanggal</b>
			<input type="date" name="enddate" min="2023-01-01" max="2023-12-31"> <b>- Komoditas : </b>
			<select id="kode_komoditas" name="kode_komoditas">
				<option value="A4">Kentang</option>
				<option value="B2">Cabe Rawit</option>
				<option value="C7">Bawang Merah</option>
				<option value="D9">Wortel</option>
			</select>
			<button type="submit" id="meanMarket" name="meanMarket">Go</button>
		</form>
		<div class="mean-pasar">
			<div>
				<canvas id="mp" style="width:100%;max-width:700px"></canvas>
			</div>
		</div>
	</div>

	<!-- Include the jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>
	$(document).ready(function(){
		submissionAjaxChangeMean('#changeMean', 'get_change_mean.php', 'changemean')
		submissionAjaxDaily('#komoditasharian', 'get_data_daily.php', 'A4');
		submissionAjaxDaily('#komoditasharian', 'get_data_daily.php', 'B2');
		submissionAjaxDaily('#komoditasharian', 'get_data_daily.php', 'C7');
		submissionAjaxDaily('#komoditasharian', 'get_data_daily.php', 'D9');
		submissionAjaxDaily('#pasarharian', 'get_data_daily.php', 'A5');
		submissionAjaxDaily('#pasarharian', 'get_data_daily.php', 'G7');
		submissionAjaxDaily('#pasarharian', 'get_data_daily.php', 'R2');
		submissionAjaxDaily('#pasarharian', 'get_data_daily.php', 'P10');
		submissionAjaxMean('#komoditasmean', 'get_data_mean.php', 'mk');
		submissionAjaxMean('#pasarmean', 'get_data_mean.php', 'mp');
	});
	</script>
	<div class="footer">
		<div class="para-footer">
			Copyrights @ 2023 Pemerintah DKI Jakarta
		</div>
		<div class="soc-med">
			<a href="" class="fa fa-facebook"></a>
			<a href="" class="fa fa-twitter"></a>
			<a href="" class="fa fa-instagram"></a>
		</div>
	</div>
</body>
</html>