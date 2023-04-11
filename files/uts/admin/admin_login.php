<?php
	include "../connection.php";
	if(isset($_POST['btnSubmit'])){

	$nama = $_POST['nama'];
	$password = $_POST['password'];
	
	session_start();

	if($nama == ""){
       header("location: /files/uts/login_page.php?pesan=kosong", true, 301);
       exit();
   	}

	$query = "select * from admin where nama='$nama' and password='$password'";
	mysqli_query($conn, $query);
	$num = mysqli_affected_rows($conn);

	if($num > 0){
		header("location: /files/uts/admin.php?nama=$nama");
		exit();
		
	}
	else{
		header("location: /files/uts/login_page.php?pesan=input");
		exit();
	}
}
?>