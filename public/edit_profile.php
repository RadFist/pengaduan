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
		?> 
		<div class="posts-section">
			<div class="post-bar">
				<div class="job_descp">
					<h3 class="mt-3">UPDATE PROFIL</h3>
					<?php
					$update = $koneksi->query("SELECT * FROM tb_user WHERE kode='$kode'");
					$hasil = $update->fetch_array();
					?>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" class="form-control" name="kode" value="<?php echo $hasil["kode"]; ?>" readonly>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="nama_user" value="<?php echo $hasil["nama_user"]; ?>" placeholder="nama_user">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="pekerjaan" value="<?php echo $hasil["pekerjaan"]; ?>" placeholder="pekerjaan">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" value="<?php echo $hasil["email"]; ?>" placeholder="email">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="no_hp" value="<?php echo $hasil["no_hp"]; ?>" placeholder="no_hp">
						</div>
						<div class="form-group">
							<input type="file" name="foto">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="tombol" value="Update Profil">
						</div>
					</form>
					<?php 
					if(@$_SESSION["user"]) { 
						$kode = @$_SESSION["user"]["kode"];
                        $update = $koneksi->query("SELECT * FROM tb_user WHERE kode='$kode'");
					    $hasil = $update->fetch_array();
                        $foto_sebelum =  $hasil["foto"];

                    }
                    $nama_user		= @$_POST["nama_user"];
					$email			= @$_POST["email"];
					$pekerjaan		= @$_POST["pekerjaan"];
					$no_hp			= @$_POST["no_hp"];

					$foto			= @$_FILES["foto"]["name"];
                    $tmp           = @$_FILES["foto"]["tmp_name"];
                    
					$directory = "foto/profile/";
					$tombol	   = @$_POST["tombol"];
                    
					if($tombol) {
						if($nama_user == "" || $email == "" || $pekerjaan == "" ||$no_hp == "" || $foto == "") {
							echo "input kosong";
						} else {
                            if($foto_sebelum != "" ){
                                unlink("foto/profile/".$foto_sebelum."");
                            }
							move_uploaded_file($tmp, $directory.$foto);
							$update = $koneksi->query("UPDATE tb_user SET 
								nama_user='$nama_user',pekerjaan='$pekerjaan',email='$email',
								no_hp='$no_hp',
								foto ='$foto'  WHERE kode='$kode'"
							);
                            if($update) {
                                echo "Data berhasil di update";
                                echo "<script>location='index.php';</script>";
                            } else {
                                echo "Data gagal di update";
                            }
						}
					}
					?>
				</div>
			</div><!--post-bar end-->
		</div><!--posts-section end-->
		<?php 
		 	
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