<?php
session_start();
include "../../connection.php";

if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['kode_pasar'])){
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $kode_pasar = $_POST['kode_pasar'];

    $commodityData = array(
        'A4' => array('categories' => array(), 'series' => array()),
        'B2' => array('categories' => array(), 'series' => array()),
        'C7' => array('categories' => array(), 'series' => array()),
        'D9' => array('categories' => array(), 'series' => array())
    );

    $query = "select tanggal, kode_komoditas, harga from price where kode_pasar='$kode_pasar' and tanggal between '$startdate' and '$enddate' group by tanggal, kode_komoditas";
    $result = mysqli_query($conn, $query);
    if(mysqli_affected_rows($conn) > 124){
        $query = "select date_format(tanggal, '%Y-%m') as month, kode_komoditas, sum(harga) as total from price where kode_pasar='$kode_pasar' and tanggal between '$startdate' and '$enddate' GROUP BY month, kode_komoditas";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)){
            $comodity = $row['kode_komoditas'];
            $month = $row['month'];
            $total = $row['total'];

            // Store the data in the appropriate commodity data array
            if (isset($commodityData[$comodity])) {
                array_push($commodityData[$comodity]['categories'], $month);
                array_push($commodityData[$comodity]['series'], $total);
            }
        }
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $comodity = $row['kode_komoditas'];
            $tanggal = $row['tanggal'];
            $harga = $row['harga'];

            // Store the data in the appropriate commodity data array
            if (isset($commodityData[$comodity])) {
                array_push($commodityData[$comodity]['categories'], $tanggal);
                array_push($commodityData[$comodity]['series'], $harga);
            }
        }
    }
    // Return the commodity data as JSON
    header('Content-Type: application/json');
    echo json_encode($commodityData);
} else if(isset($_POST['startdate']) && isset($_POST['enddate']) && isset($_POST['kode_komoditas'])){
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $kode_komoditas = $_POST['kode_komoditas'];

    $marketData = array(
        'A5' => array('categories' => array(), 'series' => array()),
        'G7' => array('categories' => array(), 'series' => array()),
        'R2' => array('categories' => array(), 'series' => array()),
        'P10' => array('categories' => array(), 'series' => array())
    );

    $query = "select tanggal, kode_pasar, harga from price where kode_komoditas='$kode_komoditas' and tanggal between '$startdate' and '$enddate' group by tanggal, kode_pasar";
    $result = mysqli_query($conn, $query);
    if(mysqli_affected_rows($conn) > 124){
        $query = "select date_format(tanggal, '%Y-%m') as month, kode_pasar, sum(harga) as total from price where kode_komoditas='$kode_komoditas' and tanggal between '$startdate' and '$enddate' GROUP BY month, kode_pasar";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)){
            $pasar = $row['kode_pasar'];
            $month = $row['month'];
            $total = $row['total'];

            // Store the data in the appropriate commodity data array
            if (isset($marketData[$pasar])) {
                array_push($marketData[$pasar]['categories'], $month);
                array_push($marketData[$pasar]['series'], $total);
            }
        }
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $pasar = $row['kode_pasar'];
            $tanggal = $row['tanggal'];
            $harga = $row['harga'];

            // Store the data in the appropriate commodity data array
            if (isset($marketData[$pasar])) {
                array_push($marketData[$pasar]['categories'], $tanggal);
                array_push($marketData[$pasar]['series'], $harga);
            }
        }
    }
    // Return the commodity data as JSON
    header('Content-Type: application/json');
    echo json_encode($marketData);
}
?>