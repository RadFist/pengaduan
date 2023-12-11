<?php  
@session_start();
if(@$_SESSION["admin"] || @$_SESSION["user"]) {
?>
<?php include "header.php"; ?>
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
		<?php 
		if(@$_SESSION["user"]) { 
			$kode = @$_SESSION["user"]["kode"];
			$data = $koneksi->query("SELECT * FROM tb_user WHERE kode= '$kode'");
			$tampil = $data->fetch_array();
			if($tampil["pekerjaan"] != "" && $tampil["no_hp"] != "" && $tampil["foto"] != "") {
		?>
		<div class="post-topbar">
			<div class="post-st">
				<ul>
					<li><a class="post-jb active" href="#" title="">Posting Laporan</a></li>
				</ul>
			</div><!--post-st end-->
		</div><!--post-topbar end-->
		<?php 
			} else {
		?>
		<div class="alert alert-success" role="alert">
		  <h1 class="alert-heading">Selamat Datang,
		  	<?php
			if(@$_SESSION["user"]) {
				echo $tampil["nama_user"];
			} else if(@$_SESSION["admin"]) {
				echo $tampil["nama_admin"];
			} 
			?>	
		  </h1>
		  <p>Untuk mengajukan pelaporan pengaduan silahkan untuk melengkapi data pribadi. </p>
		  <hr>
		  <p class="mb-0">silahkan klik link ini <a href="profil.php?=<?php echo $kode; ?>" class="alert-link">profil</a>.</p>
		</div>
		<?php
			}
		}
		?>
		<div class="posts-section">
			<?php include "slider.php"; ?>
			<?php include "time.php";  ?>
			<?php
			$a = $koneksi->query("SELECT tb_pengaduan.tgl_pengaduan,
				tb_pengaduan.judul_pengaduan,tb_pengaduan.isi_pengaduan,tb_pengaduan.id_pengaduan,tb_pengaduan.gambar_pengaduan,
				tb_pengaduan.id_user,tb_user.nama_user,tb_user.foto
				FROM(tb_pengaduan LEFT JOIN tb_user ON tb_pengaduan.id_user=
					tb_user.id_user)
				LEFT JOIN tb_login ON tb_user.kode = tb_login.kode
				ORDER BY tgl_pengaduan DESC;
				");
				$num = $a->num_rows;
				if($num > 0) {
				while ($ta = $a->fetch_array()) {	  
			?>
			<div class="post-bar">
				<div class="post_topbar">
					<div class="usy-dt">
						<?php
					
							if ($ta["foto"] != "") {
								 echo "<img src='foto/".$ta["foto"]."' width='50' height='50'/>";
							} else {
								echo "<img src='../img/avatar.png' width='50' height='50'/>";
							}
						
						?>	
						<div class="usy-name">
							<h3>
								<?php
									echo $ta["nama_user"];
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
					
					<?php
						if(@$_SESSION["user"]) {
						?>
							<div class="ed-opts" hidden>
								<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
								<ul class="ed-options">
								<li><a href="edit-post.php?id=<?php echo $ta["id_pengaduan"]; ?>" title="">Edit</a></li>
								<li><a href="delete-post.php?id=<?php echo $ta["id_pengaduan"]; ?> "  title="">Delete</a></li>
							</div>
						<?php } else {?>
							<div class="ed-opts">							
								<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
								<ul class="ed-options">
								<li><a href="edit-post.php?id=<?php echo $ta["id_pengaduan"]; ?>" title="">Edit</a></li>
								li><a href="delete-post.php?id=<?php echo $ta["id_pengaduan"]; ?> "  title="">Delete</a></li>
							</div>
						<?php }?>
				</div>

				<div class="job_descp mb-2">
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
					<p><?php echo $ta["isi_pengaduan"] ?> </p>
					<p><a href="tanggapan.php?id=<?php echo $ta["id_pengaduan"]; ?>" title=""> view more</a></p>
				</div>
				<div class="ml-3 p-2 mb-2 d-flex align-items-center ">
					<img src="images/com.png" class="mr-1" height="15px">
					<!-- total komen -->
					<?php 
						$id_pengaduan = $ta['id_pengaduan'];
						$data1 = $koneksi->query("SELECT COUNT(id_tanggapan_user) as count1 FROM tb_tanggapan_user WHERE id_pengaduan = $id_pengaduan");
						$data2 = $koneksi->query("SELECT COUNT(id_tanggapan) as count2 FROM tb_tanggapan WHERE id_pengaduan = $id_pengaduan");
						
						$row1 = $data1->fetch_assoc();
						$row2 = $data2->fetch_assoc();
						
						$count1 = $row1['count1'];
						$count2 = $row2['count2'];
						
						$total_coment = $count1 + $count2;
					?>

					<p><?php echo $total_coment ?></p>
				</div>
			</div> <!--post-bar end-->
		<?php
			} //penutup while
		} else {
			echo "";
		 } 
		 ?>
		</div><!--posts-section end-->
	</div><!--main-ws-sec end-->
</div>
</div>
</div><!-- main-section-data end-->
</div> 
</div>
</main>
<?php include "footer.php"; ?>
<?php 
} else { 
echo "<script>location='../login.php';</script>";
}  
?>