<?php
if (isset($_POST["btnSubmit"])) {
	$id_input = $_POST["id"];
	 $pasar = $_POST["pasar"];
	 $tanggal = $_POST["tanggal"];
    $tuna = $_POST["tuna"];
    $sarden = $_POST["sarden"];
    $kerang = $_POST["kerang"];
    $salmon = $_POST["salmon"];

include "connection.php";



$query = "INSERT INTO data_komoditas (pasar, tanggal, tuna, sarden, kerang, salmon)
          VALUES ('$pasar', '$tanggal', '$tuna', '$sarden', '$kerang', '$salmon');";

mysqli_query($conn, $query);
$num = mysqli_affected_rows($conn);

if ($num > 0) {
   header("location: halamanadmin.php?pesan=input", true, 301);
   exit();
} else {
   echo "Data gagal disimpan ke dalam database.";
}
}
?>   