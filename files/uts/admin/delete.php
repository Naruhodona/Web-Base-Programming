<?php
	include "../connection.php";
	// if(isset($_GET['tanggal']) && isset($_GET['kode_komoditas'] && isset($_GET['kode_pasar']))){
	$tanggal = $_GET['tanggal'];
	$kode_komoditas = $_GET['kode_komoditas'];
	$kode_pasar = $_GET['kode_pasar'];

	$query = "delete from price where tanggal='$tanggal' and kode_komoditas='$kode_komoditas' and kode_pasar='$kode_pasar'";
	mysqli_query($conn, $query);
	$num = mysqli_affected_rows($conn);


	header("location: /files/uts/show_data/show_data.php");
	exit();
// }
?>