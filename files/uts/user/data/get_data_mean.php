<?php
session_start();
include "../../connection.php";

if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['kode_pasar'])){
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $kode_pasar = $_POST['kode_pasar'];

    $mean_k = [];
    $komoditas = [];

    $query = "select kode_komoditas, avg(harga) as avg_harga from price where kode_pasar='$kode_pasar' and tanggal between '$startdate' and '$enddate' group by kode_komoditas";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $comodity = $row[0];
        $avg_harga = $row[1];

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
    }
    $data_komoditas = array('categories' => $komoditas, 'series' => $mean_k);
    // Return the commodity data as JSON
    header('Content-Type: application/json');
    echo json_encode($data_komoditas);

} else if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['kode_komoditas'])){
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $kode_komoditas = $_POST['kode_komoditas'];

    $mean_p = [];
    $pasar = [];

    $query = "select kode_pasar, avg(harga) as avg_harga from price where kode_komoditas='$kode_komoditas' and tanggal between '$startdate' and '$enddate' group by kode_pasar";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $market = $row[0];
        $avg_harga = $row[1];

        // Store the data in the appropriate commodity data array
        if ($market == 'A5'){
            $market = 'Astambul';
        } else if($market == 'G7'){
            $market = 'Gambut';
        } else if($market == 'R2'){
            $market = 'Rantau';
        } else if($market == 'P10'){
            $market = 'Pelaihari';
        }
        array_push($mean_p, $avg_harga);
        array_push($pasar, $market);
    }
    $data_pasar = array('categories' => $pasar, 'series' => $mean_p);
    // Return the commodity data as JSON
    header('Content-Type: application/json');
    echo json_encode($data_pasar);
}
?>