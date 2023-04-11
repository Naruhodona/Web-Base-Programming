<?php
    include "../connection.php";

    if(isset($_POST['submit'])){
        $harga_lama = $_POST['harga_lama'];
        $harga_baru = $_POST['harga_baru'];
        $tanggal = $_POST['tanggal'];
        $kode_komoditas = $_POST['kode_komoditas'];
        $kode_pasar = $_POST['kode_pasar'];

        $query = "UPDATE price SET harga='$harga_baru' WHERE tanggal='$tanggal' AND kode_komoditas='$kode_komoditas' AND kode_pasar='$kode_pasar' AND harga='$harga_lama'";
        $result = mysqli_query($conn, $query);

        if ($result){
            echo "Data berhasil diupdate.";
            header("location: /files/uts/show_data/show_data.php");
        } else {
            echo "Terjadi kesalahan saat mengupdate data.";
        }
    } else {
        $tanggal = $_GET['tanggal'];
        $kode_pasar = $_GET['kode_pasar'];
        $kode_komoditas = $_GET['kode_komoditas'];
        $harga_lama = $_GET['harga'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../styles/edit.css">
    <title>Edit Harga</title>
</head>
<body>
    <h1>Edit Harga</h1>
    <form method="POST" id="myForm">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" readonly>
        <label for="kode_komoditas">Kode Komoditas:</label>
        <input type="text" id="kode_komoditas" name="kode_komoditas" value="<?php echo $kode_komoditas; ?>" readonly>

        <label for="kode_pasar">Kode Pasar:</label>
        <input type="text" id="kode_pasar" name="kode_pasar" value="<?php echo $kode_pasar; ?>" readonly>

        <label for="harga_lama">Harga Lama:</label>
        <input type="number" id="harga_lama" name="harga_lama" value="<?php echo $harga_lama; ?>" readonly>

        <label for="harga_baru">Harga Baru:</label>
        <input type="number" id="harga_baru" name="harga_baru" required>

        <input type="submit" id="submit" name="submit" value="Update">
    </form>
    <?php
    }
    mysqli_close($conn);
    ?>
</body>
</html>
