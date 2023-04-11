<?php
session_start();
include "../../connection.php";

if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['kode_pasar'])){
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $kode_pasar = $_POST['kode_pasar'];

    $tanggal = [];
    $harga = [];
    $mean_k = [];
    $komoditas = [];

    $query = "SELECT tanggal, kode_komoditas, harga, CAST(AVG(harga - (SELECT harga FROM price p2 WHERE p2.tanggal < p1.tanggal AND p2.kode_komoditas=p1.kode_komoditas ORDER BY p2.tanggal DESC LIMIT 1)) AS FLOAT) AS rata_rata_perubahan_harga from price p1 where kode_pasar='$kode_pasar' and tanggal between '$startdate' and '$enddate' group by kode_komoditas, tanggal;";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $date = $row[0];
        $comodity = $row[1];
        $price = $row[2];
        $avg_harga = $row[3];

        // Store the data in the appropriate commodity data array
        if ($comodity == 'A4'){
            $comodity = 'Kentang';
        } else if($comodity == 'B2'){
            $comodity = 'Cabe Rawit';
        } else if($comodity == 'C7'){
            $comodity = 'Bawang Merah';
        } else if($comodity == 'D9'){
            $comodity = 'Wortel';
        }
        array_push($mean_k, $avg_harga);
        array_push($komoditas, $comodity);
        array_push($tanggal, $date);
        array_push($harga, $price);
    }
    $data_komoditas = array('tanggal' => $tanggal, 'komoditas' => $komoditas, 'harga' => $harga, 'mean' => $mean_k);
    // Return the commodity data as JSON
    header('Content-Type: application/json');
    echo json_encode($data_komoditas);

}
?>