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
		<div class="posts-section">
			<div class="post-bar">
				<div class="job_descp">
					<h3 class="mt-3">PROFIL PENGGUNA</h3>
					<?php
					$data2 = $koneksi->query("SELECT tb_login.kode, tb_login.username, tb_user.email, tb_user.nama_user, tb_user.pekerjaan, tb_user.no_hp
					 FROM (tb_login LEFT JOIN tb_user ON tb_login.kode=tb_user.kode) 
					 WHERE tb_login.kode='$kode'");
					$tampil2 = $data2->fetch_array();
					?>
					<table class="table table-striped">
						<tr>
							<td>NAMA USER</td>
							<td>:</td>
							<td><?php echo $tampil2["nama_user"]; ?></td>
						</tr>
						<tr>
							<td>KODE</td>
							<td>:</td>
							<td><?php echo $tampil2["kode"]; ?></td>
						</tr>
						<tr>
							<td>USERNAME</td>
							<td>:</td>
							<td><?php echo $tampil2["username"]; ?></td>
						</tr>
						<tr>
							<td>EMAIL</td>
							<td>:</td>
							<td><?php echo $tampil2["email"]; ?></td>
						</tr>
						<tr>
							<td>PEKERJAAN</td>
							<td>:</td>
							<td><?php echo $tampil2["pekerjaan"]; ?></td>
						</tr>
						<tr>
							<td>NO HP</td>
							<td>:</td>
							<td><?php echo $tampil2["no_hp"]; ?></td>
						</tr>
					</table>
					<a href="edit_profile.php?kode=<?php echo $kode; ?>" class="alert-link btn btn-primary">update profile</a>
				
				</div>
			</div><!--post-bar end-->
		</div><!--posts-section end-->
		<?php 
			} else{
				echo "<script>location='edit_profile.php';</script>";
		 	}
		}else{ 
			$kode = @$_SESSION["admin"]["kode"];
			$data = $koneksi->query("SELECT * FROM tb_admin WHERE kode= '$kode'");
			$tampil = $data->fetch_array();
			?>
			<div class="posts-section">
			<div class="post-bar">
				<div class="job_descp">
					<h3 class="mt-3">PROFIL ADMIN</h3>
					<?php
					$data2 = $koneksi->query("SELECT tb_login.kode, tb_login.username,tb_admin.nama_admin
					 FROM (tb_login LEFT JOIN tb_admin ON tb_login.kode=tb_admin.kode) 
					 WHERE tb_login.kode='$kode'");
					$tampil2 = $data2->fetch_array();
					?>
					<table class="table table-striped">
						<tr>
							<td>NAMA ADMIN</td>
							<td>:</td>
							<td><?php echo $tampil2["nama_admin"]; ?></td>
						</tr>
						<tr>
							<td>KODE</td>
							<td>:</td>
							<td><?php echo $tampil2["kode"]; ?></td>
						</tr>
						<tr>
							<td>USERNAME</td>
							<td>:</td>
							<td><?php echo $tampil2["username"]; ?></td>
						</tr>
						<tr>
							<td>JOBDESC</td>
							<td>:</td>
							<td><?php echo "admin" ?></td>
						</tr>
						
					</table>
				</div>
			</div><!--post-bar end-->
		</div><!--posts-section end-->

		<?php } ?>
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