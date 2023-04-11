<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Komoditas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../styles/komoditas.css">
</head>
<body>
	<div class="header">
		<div class="logo">
            <img src="../../picture/logo.png" width="50%">
        </div>
        <div class="nav">
            <a href="../home.php"><div>Home</div></a>
			<a href="komoditas.php"><div style="color: black;">Komoditas</div></a>
			<a href="../pasar/pasar.php"><div>Pasar</div></a>
            <a href="../data/data.php"><div>Data</div></a>
        </div>
	</div>
	<h2 style="text-align: center;">Komoditas</h2>
	<div class="komoditas">
		<div class="list-komoditas">
			<div class="img-komoditas">
				<img src="../../picture/kentang.png">
			</div>
			<div class="desc-komoditas">
				<p>Kentang adalah jenis umbi-umbian yang sering digunakan sebagai bahan makanan di seluruh dunia. Kentang memiliki rasa yang netral dan tekstur yang lembut saat dimasak, sehingga mudah diolah menjadi berbagai hidangan seperti kentang goreng, kentang rebus, kentang panggang, atau mashed potato. Kentang mengandung berbagai nutrisi penting seperti karbohidrat, serat, vitamin B6, potassium, dan vitamin C. Kentang juga memiliki sifat rendah kalori dan rendah lemak sehingga dapat menjadi pilihan yang sehat sebagai bagian dari pola makan yang seimbang.</p>
			</div>
			<div class="table-komoditas">
				<?php
				include "../../connection.php";
				$today = date("Y-m-d");
				$year = (int) date("Y");
				$month = (int) date("m");
				$day = (int) date("d");
				for($i = 1; $i < 7; $i++){
					$day--;
					if($day == 0){
						$month--;
						if($month == 0){
							$year--;
							$month = 12;
							$day = 31;
						}
						else if($month == 1 or $month == 3 or $month == 5 or $month == 7 or $month == 8 or $month == 10 or $month == 12){
							$day = 31;
						}else if($month == 4 or $month == 6 or $month == 9 or $month == 11){
							$day = 30;
						}else if($month == 2 and ($year % 4) != 0){
							$day = 28;
						}else if($month == 2 and ($year % 4) == 0){
							$day = 29;
						}
					}
				}
				if($day == 1 or $day == 2 or $day == 3 or $day == 4 or $day == 5 or $day == 6 or $day == 7 or $day == 8 or $day == 9){
					$day = "0". (String) $day;
				}

				if($month == 1 or $month == 2 or $month == 3 or $month == 4 or $month == 5 or $month == 6 or $month == 7 or $month == 8 or $month == 9){
					$month = "0". (String) $month;
				}
				$year = (String) $year;
				$date = $year . "-" . $month . "-" . $day;
				$query = "select kode_pasar, avg(harga) as avg_harga from price where kode_komoditas='A4' and tanggal between '$date' and '$today' group by kode_pasar";
				$result = mysqli_query($conn, $query);

				if ($result){
				?>
				<?php
				$query_b = "select min(harga) from price where kode_komoditas='A4' and tanggal='$today'";
				$result_b = mysqli_query($conn, $query_b);
				$row_b = mysqli_fetch_row($result_b);
				$price = $row_b[0];
				$query_a = "select kode_pasar from price where kode_komoditas='A4' and harga=$price and tanggal='$today'";
				$result_a = mysqli_query($conn, $query_a);
				$row_a = mysqli_fetch_row($result_a);
				$market = $row_a[0];

				if ($market == 'A5'){
		            $market = 'Astambul';
		        } else if($market == 'G7'){
		            $market = 'Gambut';
		        } else if($market == 'R2'){
		            $market = 'Rantau';
		        } else if($market == 'P10'){
		            $market = 'Pelaihari';
		        }

				?>
				<p class="cheapest">Harga termurah saat ini ada di pasar <?php echo $market; ?> dengan harga <?php echo $price; ?></p>

				<h2>Harga rata-rata kentang dari tanggal <?php echo $date; ?> s/d <?php echo $today; ?> (7 hari terakhir)</h2>
				<table border="1" style="width: 50%; margin-left: auto; margin-right: auto;">
					<tr>
						<th width="100">Pasar</th>
						<th width="100">Rata-rata</th>
					</tr>
				<?php
				while ($row = mysqli_fetch_row($result)){
				?>
					<tr><?php 
					$pasar = $row[0];
					$mean = $row[1];
					?>
						<td><?php 
						if ($pasar == 'A5'){
				            $pasar = 'Astambul';
				        } else if($pasar == 'G7'){
				            $pasar = 'Gambut';
				        } else if($pasar == 'R2'){
				            $pasar = 'Rantau';
				        } else if($pasar == 'P10'){
				            $pasar = 'Pelaihari';
				        }
							echo $pasar;?></td>
						<td><?php echo $mean;?></td>
					</tr>
				<?php
					}
				}
				?>
				</table>
			</div>
		</div>
		<div class="list-komoditas">
			<div class="img-komoditas">
				<img src="../../picture/cabe.png">
			</div>
			<div class="desc-komoditas">
				<p>Cabe rawit adalah jenis cabai yang biasanya digunakan sebagai bumbu atau tambahan pada masakan untuk menambahkan rasa pedas. Cabe rawit berbentuk kecil, lonjong, dan berwarna hijau atau merah tergantung dari tingkat kematangan. Rasa pedas pada cabe rawit disebabkan oleh kandungan zat capsaicin yang juga memberikan banyak manfaat kesehatan, termasuk membantu meningkatkan metabolisme tubuh dan mengurangi risiko penyakit jantung. Meskipun memiliki ukuran yang kecil, cabe rawit sangat pedas sehingga harus digunakan dengan hati-hati dan dalam jumlah yang sesuai dengan selera masing-masing.</p>
			</div>
			<div class="table-komoditas">
				<?php
				$query = "select kode_pasar, avg(harga) as avg_harga from price where kode_komoditas='B2' and tanggal between '$date' and '$today' group by kode_pasar";
				$result = mysqli_query($conn, $query);

				if ($result){
				?>
				<?php
				$query_b = "select min(harga) from price where kode_komoditas='B2' and tanggal='$today'";
				$result_b = mysqli_query($conn, $query_b);
				$row_b = mysqli_fetch_row($result_b);
				$price = $row_b[0];
				$query_a = "select kode_pasar from price where kode_komoditas='B2' and harga=$price and tanggal='$today'";
				$result_a = mysqli_query($conn, $query_a);
				$row_a = mysqli_fetch_row($result_a);
				$market = $row_a[0];

				if ($market == 'A5'){
		            $market = 'Astambul';
		        } else if($market == 'G7'){
		            $market = 'Gambut';
		        } else if($market == 'R2'){
		            $market = 'Rantau';
		        } else if($market == 'P10'){
		            $market = 'Pelaihari';
		        }

				?>
				<p class="cheapest">Harga termurah saat ini ada di pasar <?php echo $market; ?> dengan harga <?php echo $price; ?></p>
				<h2>Harga rata-rata cabe rawit dari tanggal <?php echo $date; ?> s/d <?php echo $today; ?> (7 hari terakhir)</h2>
				<table border="1" style="width: 50%; margin-left: auto; margin-right: auto;">
					<tr>
						<th width="100">Pasar</th>
						<th width="100">Rata-rata</th>
					</tr>
				<?php
				while ($row = mysqli_fetch_row($result)){
				?>
					<tr><?php 
					$pasar = $row[0];
					$mean = $row[1];
					?>
						<td><?php 
						if ($pasar == 'A5'){
				            $pasar = 'Astambul';
				        } else if($pasar == 'G7'){
				            $pasar = 'Gambut';
				        } else if($pasar == 'R2'){
				            $pasar = 'Rantau';
				        } else if($pasar == 'P10'){
				            $pasar = 'Pelaihari';
				        }
							echo $pasar;?></td>
						<td><?php echo $mean;?></td>
					</tr>
				<?php
					}
				}
				?>
				</table>
			</div>
		</div>
		<div class="list-komoditas">
			<div class="img-komoditas">
				<img src="../../picture/bawang.png">
			</div>
			<div class="desc-komoditas">
				<p>Bawang merah adalah jenis umbi-umbian yang sering digunakan sebagai bahan masakan di seluruh dunia. Bawang merah memiliki rasa yang lebih manis dan lembut dibandingkan dengan bawang putih, dan sering digunakan sebagai bahan dasar dalam pembuatan saus, masakan tumis, dan berbagai hidangan lainnya. Bawang merah juga mengandung berbagai nutrisi penting seperti vitamin C, serat, dan antioksidan yang bermanfaat untuk menjaga kesehatan tubuh. Selain itu, bawang merah juga memiliki sifat antimikroba yang dapat membantu melawan infeksi dan menjaga kesehatan sistem kekebalan tubuh.</p>
			</div>
			<div class="table-komoditas">
				<?php
				$query = "select kode_pasar, avg(harga) as avg_harga from price where kode_komoditas='C7' and tanggal between '$date' and '$today' group by kode_pasar";
				$result = mysqli_query($conn, $query);

				if ($result){
				?>
				<?php
				$query_b = "select min(harga) from price where kode_komoditas='C7' and tanggal='$today'";
				$result_b = mysqli_query($conn, $query_b);
				$row_b = mysqli_fetch_row($result_b);
				$price = $row_b[0];
				$query_a = "select kode_pasar from price where kode_komoditas='C7' and harga=$price and tanggal='$today'";
				$result_a = mysqli_query($conn, $query_a);
				$row_a = mysqli_fetch_row($result_a);
				$market = $row_a[0];

				if ($market == 'A5'){
		            $market = 'Astambul';
		        } else if($market == 'G7'){
		            $market = 'Gambut';
		        } else if($market == 'R2'){
		            $market = 'Rantau';
		        } else if($market == 'P10'){
		            $market = 'Pelaihari';
		        }

				?>
				<p class="cheapest">Harga termurah saat ini ada di pasar <?php echo $market; ?> dengan harga <?php echo $price; ?></p>
				<h2>Harga rata-rata bawang merah dari tanggal <?php echo $date; ?> s/d <?php echo $today; ?> (7 hari terakhir)</h2>
				<table border="1" style="width: 50%; margin-left: auto; margin-right: auto;">
					<tr>
						<th width="100">Pasar</th>
						<th width="100">Rata-rata</th>
					</tr>
				<?php
				while ($row = mysqli_fetch_row($result)){
				?>
					<tr><?php 
					$pasar = $row[0];
					$mean = $row[1];
					?>
						<td><?php 
						if ($pasar == 'A5'){
				            $pasar = 'Astambul';
				        } else if($pasar == 'G7'){
				            $pasar = 'Gambut';
				        } else if($pasar == 'R2'){
				            $pasar = 'Rantau';
				        } else if($pasar == 'P10'){
				            $pasar = 'Pelaihari';
				        }
							echo $pasar;?></td>
						<td><?php echo $mean;?></td>
					</tr>
				<?php
					}
				}
				?>
				</table>
			</div>
		</div>
		<div class="list-komoditas">
			<div class="img-komoditas">
				<img src="../../picture/wortel.png">
			</div>
			<div class="desc-komoditas">
				<p>Wortel adalah jenis sayuran yang memiliki bentuk silindris dan berwarna oranye. Wortel mengandung banyak nutrisi penting seperti vitamin A, serat, potassium, dan antioksidan. Sayuran ini memiliki berbagai manfaat kesehatan, termasuk membantu menjaga kesehatan mata, meningkatkan sistem kekebalan tubuh, dan menjaga kesehatan kulit. Wortel dapat diolah menjadi berbagai hidangan, mulai dari jus, sup, hingga salad, dan juga sering digunakan sebagai bahan dalam masakan sehari-hari.</p>
			</div>
			<div class="table-komoditas">
				<?php
				$query = "select kode_pasar, avg(harga) as avg_harga from price where kode_komoditas='D9' and tanggal between '$date' and '$today' group by kode_pasar";
				$result = mysqli_query($conn, $query);

				if ($result){
				?>
				<?php
				$query_b = "select min(harga) from price where kode_komoditas='D9' and tanggal='$today'";
				$result_b = mysqli_query($conn, $query_b);
				$row_b = mysqli_fetch_row($result_b);
				$price = $row_b[0];
				$query_a = "select kode_pasar from price where kode_komoditas='D9' and harga=$price and tanggal='$today'";
				$result_a = mysqli_query($conn, $query_a);
				$row_a = mysqli_fetch_row($result_a);
				$market = $row_a[0];

				if ($market == 'A5'){
		            $market = 'Astambul';
		        } else if($market == 'G7'){
		            $market = 'Gambut';
		        } else if($market == 'R2'){
		            $market = 'Rantau';
		        } else if($market == 'P10'){
		            $market = 'Pelaihari';
		        }

				?>
				<p class="cheapest">Harga termurah saat ini ada di pasar <?php echo $market; ?> dengan harga <?php echo $price; ?></p>
				<h2>Harga rata-rata dari wortel tanggal <?php echo $date; ?> s/d <?php echo $today; ?> (7 hari terakhir)</h2>
				<table border="1" style="width: 50%; margin-left: auto; margin-right: auto;">
					<tr>
						<th width="100">Pasar</th>
						<th width="100">Rata-rata</th>
					</tr>
				<?php
				while ($row = mysqli_fetch_row($result)){
				?>
					<tr><?php 
					$pasar = $row[0];
					$mean = $row[1];
					?>
						<td><?php 
						if ($pasar == 'A5'){
				            $pasar = 'Astambul';
				        } else if($pasar == 'G7'){
				            $pasar = 'Gambut';
				        } else if($pasar == 'R2'){
				            $pasar = 'Rantau';
				        } else if($pasar == 'P10'){
				            $pasar = 'Pelaihari';
				        }
							echo $pasar;?></td>
						<td><?php echo $mean;?></td>
					</tr>
				<?php
					}
				}
				?>
				</table>
			</div>
		</div>
	</div>
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