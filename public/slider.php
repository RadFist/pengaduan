<div class="widget widget-jobs">
	<div class="sd-title">
		<h3>Pengguna Aplikasi</h3>
	</div>
	<div class="profiles-slider">
		<?php
		include "../config.php";
		$query =$koneksi->query("SELECT * FROM tb_user");
		while($user=$query->fetch_array()){
			if($user["kode"]!=@$_SESSION["user"]["kode"]){			
		?>
		<div class="user-profy">
			<?php
			if($user['foto']!=""){
				echo "<img src='foto/profile/".$user['foto']."' alt='' width='57' height='57'>";
			}else{
				echo "<img src='../img/avatar.png' alt='' width='57' height='57'>";				
			}
			?>
			<h3><?php echo $user["nama_user"]; ?></h3>
			<span><?php echo $user["pekerjaan"]; ?></span>
			<ul>
				<li>
				<?php 
				$follower = @$_SESSION["user"]["kode"];
				$following = $user["kode"]; 

				$fo = $koneksi -> query("SELECT * FROM tb_user_follow where kode = '$follower' AND following ='$following'");
				$newfo = $fo->num_rows;
				?>
				<style type="text/css">
					.tombol{
						padding: 5px;
						cursor: pointer;
						box-shadow: none;
						border-color: none;
						margin: 0;
					}
				</style>
				<form action="" method="POST">
					<input type="hidden" name="id" value="<?php echo $following; ?>">
					<?php
					if($newfo>0){
						echo'<button><a href="unfollow.php?kode='.$user['kode'].'" class="tombol bg-secondary">unfollow</a></button>';
					}else{
						echo '<input type="submit" class="tombol bg-succsess text white" name="sub" value="follow">';
					}
					 ?>
				</form>
				</li>
			</ul>
		</div><!--user-profy end-->
		<?php }} ?>

		<?php 
		$tz = 'Asia/jakarta';
		$dt = new DateTime("now",new DateTimeZone($tz));
		$date =$dt->format('y-m-d G:i:s');

		$id = @$_POST["id"];
		$sub = @$_POST["sub"];
		$unsub = @$_POST["unsub"];
		if($sub){
			$relod=$koneksi->query("INSERT INTO tb_user_follow (`kode`, `following`, `subscribed`) VALUES('$follower','$id','$date')");
			if($relod){
				echo"<script>location='index.php';</script>";
			}
		}
		?>


	</div><!--profiles-slider end-->
</div><!--top-profiles end-->