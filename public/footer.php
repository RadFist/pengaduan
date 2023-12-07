<div class="post-popup job_post">
<div class="post-project">
<h3>Tulis Laporan</h3>
<div class="post-project-fields">
<form action="" method="POST" enctype="multipart/form-data">
	<div class="row">
	<div class="col-lg-12">
		<input type="hidden" name="user" value="<?php echo $tampil["id_user"] ?>">
	</div>
	<div class="col-lg-12">
		<input type="text" name="title" placeholder="Title">
	</div>
	<div class="col-lg-12">
		<textarea name="description" placeholder="Description"></textarea>
	</div>
	<div class="col-lg-12">
		<input type="file" name="gambar">
	</div>
	<div class="col-lg-12">
		<input type="submit" class="btn btn-danger" name="post" value="Post">
	</div>
	</div>
</form>
<?php  
include "../config.php";
$user 		= @$_POST["user"];
$judul 		= @$_POST["title"];
$deskripsi 	= @$_POST["description"];
$posting 	= @$_POST["post"];

	$tz ='Asia/Jakarta';
	$dt	= new DateTime("now", new DateTimezone($tz));
	$date = $dt->format('Y-m-d G:i:s'); 

$gambar 	=@$_FILES["gambar"]["name"];
$asalgambar =@$_FILES["gambar"]["tmp_name"];

$simpangambar = "foto/";

if($posting) {
	move_uploaded_file($asalgambar, $simpangambar.$gambar);
	$data = $koneksi->query("INSERT INTO tb_pengaduan VALUES('','$user','$judul','$deskripsi','$gambar','$date')");
	if($data) {
		echo "<script>location='#';</script>";
	}
}
?>
</div><!--post-project-fields end-->
<a href="#" title=""><i class="la la-times-circle-o"></i></a>
</div><!--post-project end-->
</div><!--post-project-popup end-->

</div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>