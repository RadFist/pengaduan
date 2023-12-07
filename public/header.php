<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<style type="text/css">
.user-profy {
border-top: 1px solid #ececec;
}
</style>
</head>
<body>
<div class="wrapper">
<header>
<div class="container">
<div class="header-data">
<div class="logo">
<a href="index.php" title=""><img src="images/logo.png" alt=""></a>
</div><!--logo end-->
<div class="search-bar navbar">
<h1 class="text-center text-white h6">Aplikasi Pengaduan Masyarakat</h1>
</div><!--search-bar end-->
<nav>
<ul>
<li>
	<a href="index.php" title="">
		<span><img src="images/icon1.png" alt=""></span>
		Home
	</a>
</li>
<li>
	<a href="profil.php" title="">
		<span><img src="images/icon4.png" alt=""></span>
		Profil
	</a>
</li>
<li>
	<a href="post_user.php" title="">
		<span><img src="images/icon9.png" alt=""></span>
		Postingan
	</a>
</li>
</ul>
</nav><!--nav end-->

<div class="user-account">
<div class="user-info">
<?php  
include "../config.php";
if(@$_SESSION["user"]) {
	$aktif = @$_SESSION["user"]["kode"];
	$data = $koneksi->query("SELECT * FROM tb_user WHERE kode='$aktif'");
	$tampil = $data->fetch_array();
} else if(@$_SESSION["admin"]) {
	$aktif = @$_SESSION["admin"]["kode"];
	$data = $koneksi->query("SELECT * FROM tb_admin WHERE kode='$aktif'");
	$tampil = $data->fetch_array();
}
?>
<?php
if(@$_SESSION["user"]) {
	if ($tampil["foto"] != "") {
		 echo "<img src='foto/profile/".$tampil["foto"]."' width='30' height='30'/>";
	} else {
		echo "<img src='../img/avatar.png' width='30' height='30'/>";
	}
} 
?>		

<a href="#" title="">
	<?php
	if(@$_SESSION["user"]) {
		echo $tampil["nama_user"];
	} else if(@$_SESSION["admin"]) {
		echo $tampil["nama_admin"];
	} 
	?>		
</a>
<i class="la la-sort-down"></i>
</div>
<div class="user-account-settingss">
<h3 class="tc"><a href="../logout.php" title="">Logout</a></h3>
</div><!--user-account-settingss end-->
</div>
</div><!--header-data end-->
</div>
</header><!--header end-->