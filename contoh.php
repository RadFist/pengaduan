<?php  
include "config.php";
@session_start();
$user 	= @$_POST["user"];
$pass 	= @$_POST["pass"];
$tombol = @$_POST["tombol"];

if($tombol) {
	if($user == "sudaya" || $pass == "wulan") {
		if($akun["level"] == "admin") {
            $_SESSION["admin"] = $akun;
            echo "<script>location='public/index.php';</script>";
        }

	} else {
		echo "username/password salah!";
	}
}
?>