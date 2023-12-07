<?php @session_start();
if(@$_SESSION["user"]){
    ?>
<?php include "header.php";
    
    $kode = @$_SESSION["user"]["kode"];
    $data = $koneksi->query("SELECT * FROM tb_user WHERE kode= '$kode'");
    $tampil = $data->fetch_array();

?>
 
<main>
<div class="main-section">
<div class="container">
<div class="main-section-data">
<div class="row">
<div class="col-lg-3 col-md-4 pd-left-none no-pd">
	<div class="main-left-sidebar no-margin">
		<div class="user-data full-width">
            <?php include "sidebar.php"; ?>      
        </div><!--user-data end-->
	</div><!--main-left-sidebar end-->
</div>
<div class="col-lg-9 col-md-8 no-pd">
    <div class="main-ws-sec">

    
		<div class="post-topbar">
			<div class="post-st">
				<ul>
					<li><a class="post-jb active" href="#" title="">Posting Laporan</a></li>
				</ul>
			</div><!--post-st end-->
		</div><!--post-topbar end-->


        <div class="posts-section">
			<?php include "time.php";  ?>
			<?php
			$a = $koneksi->query("SELECT tb_pengaduan.tgl_pengaduan,
				tb_pengaduan.judul_pengaduan,tb_pengaduan.isi_pengaduan,tb_pengaduan.id_pengaduan,tb_pengaduan.gambar_pengaduan
				FROM(tb_pengaduan LEFT JOIN tb_user ON tb_pengaduan.id_user=
					tb_user.id_user)
				LEFT JOIN tb_login ON tb_user.kode=tb_login.kode WHERE 
					tb_login.kode='$kode' ORDER BY tgl_pengaduan DESC;
				");
				$num = $a->num_rows;
				if($num > 0) {
				while ($ta = $a->fetch_array()) {	  
			?>
			<div class="post-bar">
				<div class="post_topbar">
					<div class="usy-dt">
						<?php
						if(@$_SESSION["user"]) {
							if ($tampil["foto"] != "") {
								 echo "<img src='foto/".$tampil["foto"]."' width='50' height='50'/>";
							} else {
								echo "<img src='../img/avatar.png' width='50' height='50'/>";
							}
						} 
						?>		
						<div class="usy-name">
							<h3>
								<?php
								if(@$_SESSION["user"]) {
									echo $tampil["nama_user"];
								}
								?>
							</h3>
							<span><img src="images/clock.png" alt="">
								<?php
								$date = $ta["tgl_pengaduan"];
								echo TimeAgo($date, date("Y-m-d H:i:s")); 
								 ?>
						</span>
						</div>
					</div>
					<div class="ed-opts">
						<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
						<ul class="ed-options">
							<li><a href="edit-post.php?id=<?php echo $ta["id_pengaduan"]; ?>" title="">Edit</a></li>
							<li><a href="delete-post.php?id=<?php echo $ta["id_pengaduan"]; ?> "  title="">Delete</a></li>
					</div>
				</div>
				<div class="job_descp">
					<h3><?php echo $ta["judul_pengaduan"]; ?></h3>
					<?php 
					if($ta["gambar_pengaduan"]!=""){
						?>
					<img src="foto/<?php echo $ta["gambar_pengaduan"]; ?>" alt="" class="mb-3 img-thumbnail col-lg-12">
					<?php 
					}else{
						echo "";
					}
					?>
					<p><?php echo $ta["isi_pengaduan"] ?>
					<a href="#" title=""> view more</a></p>
				</div>
			</div><!--post-bar end-->
		<?php
			} //penutup while
		} else {
			echo "";
		 } 
		 ?>
		</div><!--posts-section end-->


    </div> <!--main-wc-sec end-->
</div>
</div>
</div>
</div>
</div>
</main>
<?php include "footer.php"; ?>
<?php }else{
    echo "<script>location='../login.php';</script>";
    } ?>
