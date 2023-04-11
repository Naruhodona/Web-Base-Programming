<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../styles/show_data.css">
  <title>Data Harga Komoditas</title>
</head>
<body>
	<a href="../admin/admin.php" class="back">Back</a>
	<h1>Harga Komoditas</h1>
	<div class="filter">
		<form method="POST">
			<span>Tanggal data tampil : </span>
			<input type="date" name="requestdate">
			<input type="submit" name="filterBtn" value="Filter">
		</form>
	</div>
	

  <?php
    include "../connection.php";
    if(isset($_POST['filterBtn'])){
    $date = $_POST['requestdate'];
    $query = "select * from price where tanggal='$date' limit 16";
    $result = mysqli_query($conn, $query);

    if ($result){
  ?>
  
  <table border="1" id="data">
    <tr>
      <th width="100">Tanggal</th>
      <th width="100">Kode Komoditas</th>
      <th width="100">Kode Pasar</th>
      <th width="100">Harga</th>
      <th width="100">Action</th>
    </tr>
  <?php
  while ($row = mysqli_fetch_row($result)){
  ?>
    <tr>
		<td><?php echo $row[0];?></td>
		<td><?php echo $row[1];?></td>
		<td><?php echo $row[2];?></td>
		<td><?php echo $row[3];?></td>
		<td>
			<a href="../admin/edit.php?tanggal=<?php echo $row[0];?>&kode_komoditas=<?php echo $row[1];?>&kode_pasar=<?php echo $row[2];?>&harga=<?php echo $row[3];?>" style="background-color: limegreen;">Edit</a> |
			<a href="../admin/delete.php?tanggal=<?php echo $row[0];?>&kode_komoditas=<?php echo $row[1];?>&kode_pasar=<?php echo $row[2];?>" style="background-color: red;">Delete</a>
		</td>
	</tr>
	<?php
		}
	?>	
	</table>
	<?php
		mysqli_free_result($result);
		}
	}
	mysqli_close($conn);	
	?>
</body>
</html>