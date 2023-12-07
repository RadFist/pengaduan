<div class="user-profile">
	<div class="username-dt">
		<div class="usr-pic">
			<?php
			if(@$_SESSION["user"]) {
				if ($tampil["foto"] != "") {
					 echo "<img src='foto/profile/".$tampil["foto"]."' width='100' height='100'/>";
				} else {
					echo "<img src='../img/avatar.png' width='100' height='100'/>";
				}
			} 
			?>
		</div>
	</div>
	<!--username-dt end-->
	<div class="user-specs">
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
		<h3>
			<?php
			if(@$_SESSION["user"]) {
				echo $tampil["nama_user"];
			} else if(@$_SESSION["admin"]) {
				echo $tampil["nama_admin"];
			} 
			?>							
		</h3>
		<span>
			<?php
			if(@$_SESSION["user"]) {
				echo $tampil["pekerjaan"];
			} else if(@$_SESSION["admin"]) {
			} 
			?>	
		</span>
	</div>
</div><!--user-profile end-->
<ul class="user-fw-status">
	<?php
	$akun = @$_SESSION["user"]["kode"];
	$variable = $koneksi->query("SELECT * FROM tb_user_follow WHERE kode ='$akun'");
	$jum = $variable->num_rows;
	?>
	<li>
		<h4>Following</h4>
		<span><?php echo $jum; ?></span>
	</li>
	<?php 
	$akun2 = @$_SESSION["user"]["kode"];
	$variable2 = $koneksi->query("SELECT * FROM tb_user_follow WHERE following ='$akun'");
	$jum2 = $variable2->num_rows;
	?>

	<li>
		<h4>Followers</h4>
		<span><?php echo $jum2; ?></span>
	</li>
	<li>
		<a href="../logout.php" title="">Logout</a>
	</li>
</ul>

