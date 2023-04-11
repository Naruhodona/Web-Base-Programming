<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Insert Data</title>
	<link rel="stylesheet" type="text/css" href="../styles/admin.css">
	
</head>
<body>
	<a href="../index.php" class="showdata" style="margin-top: 10px;">Back to login page</a>
	<h1>Form Isi Data</h1>
	<form method="POST">
		<label>Tanggal:</label>
		<input type="date" name="tanggal" required><br><br>
		
		<label for="komoditas">Nama Komoditas:</label>
		<select name="kode_komoditas" id="komoditas" required>
		    <option value="A4">Kentang </option>
		    <option value="B2">Cabe Rawit</option>
		    <option value="C7">Bawang Merah</option>
		    <option value="D9">Wortel</option>
		</select>
		<br><br>

		<label for="pasar">Nama Pasar:</label>
		<select name="kode_pasar" id="pasar" required>
		    <option value="A5">Astambul</option>
		    <option value="G7">Gambut</option>
		    <option value="R2">Rantau</option>
		    <option value="P10">Pelaihari</option>
		</select>
		<br><br>
		
		<label>Harga:</label>
		<input type="number" name="harga" required><br><br>
		<div style="display: flex; justify-content: space-between;">
			<input type="submit" name="btnSubmit" value="Submit">
			<a href="../show_data/show_data.php" class="showdata">Data Harga Komoditas</a>
		</div>
		
	</form>

	<?php
		include "../connection.php";
		if(isset($_POST['btnSubmit'])){
	
		$tanggal = $_POST['tanggal'];
		$kode_komoditas = $_POST['kode_komoditas'];
		$kode_pasar = $_POST['kode_pasar'];
		$harga = $_POST['harga'];

		$tanggal_convert = date('Y-m-d', strtotime($tanggal));

		$query = "INSERT INTO price(tanggal, kode_komoditas, kode_pasar, harga) VALUES(STR_TO_DATE('$tanggal_convert', '%Y-%m-%d'), '$kode_komoditas', '$kode_pasar', $harga)";
		mysqli_query($conn, $query);

		if(mysqli_affected_rows($conn) > 0){
			echo "Data berhasil ditambahkan.";
		} else {
			echo "Data gagal ditambahkan.";
		}
	}
	mysqli_close($conn);
	?>
</body>
	