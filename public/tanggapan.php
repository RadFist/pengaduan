<?php @session_start();
 include "header.php"; ?>
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
    <?php include "time.php";  ?>
    <?php
        $id = $_GET["id"];
			$a = $koneksi->query("SELECT tb_pengaduan.tgl_pengaduan,
				tb_pengaduan.judul_pengaduan,tb_pengaduan.isi_pengaduan,tb_pengaduan.id_pengaduan,tb_pengaduan.gambar_pengaduan,
				tb_pengaduan.id_user,tb_user.nama_user,tb_user.foto
				FROM(tb_pengaduan LEFT JOIN tb_user ON tb_pengaduan.id_user=
					tb_user.id_user) WHERE id_pengaduan = $id
				");
				$num = $a->num_rows;
				$ta = $a->fetch_array();
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
                </div>

				<div class="job_descp mt-3">
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
					<p class="mb-5"><?php echo $ta["isi_pengaduan"] ?></p>
                    
                    <div class="post-comment">
                        <h3>KOLOM TANGGAPAN</h3>
                        <div class="ml-2">

                            <?php 
                            if(@$_SESSION["user"]){ 
                            if ($ta["foto"] != "") {
                                echo "<img src='foto/".$tampil["foto"]."' width='35' height='35'/>";
							} 
                        }else{
                            echo "<img src='../img/avatar.png' width='35' height='35'/>";
                        }
						?>	
                        <div class="post_comment_sec ml-4 mb-5">
                            <form action="" method="POST">
                                <textarea name="komen" placeholder="komentar" ></textarea>
                                <button type="submit" name="submit" value="submit">SEND</button>
                            </form>
						</div>
                            <!-- logic comment -->
							<?php      
                        $tz ='Asia/Jakarta';
                        $dt	= new DateTime("now", new DateTimezone($tz));
                        $date = $dt->format('Y-m-d G:i:s');
						
						if(isset($_POST['submit']) == "submit"){
                        
							// admin logic
						if(@$_SESSION["admin"]){
                        $id_admin = $tampil["id_admin"];
                        $id_pengaduan= $ta['id_pengaduan'];
                        $koment= $_POST['komen'];
                            
                        $koneksi->query("INSERT INTO tb_tanggapan (`id_admin`, `id_pengaduan`, `isi_tanggapan`, `tgl_tanggapan`) VALUES('$id_admin','$id_pengaduan','$koment','$date')");
                        
						}elseif(@$_SESSION["user"]){
							$id_user = $tampil["id_user"];
							$id_pengaduan= $ta['id_pengaduan'];
							$koment= $_POST['komen'];		
							$koneksi->query("INSERT INTO tb_tanggapan_user (`id_user`, `id_pengaduan`, `isi_tanggapan_user`, `tgl_tanggapan_user`) VALUES('$id_user','$id_pengaduan','$koment','$date')");
							}else{ echo "error"; }

						}?>


						<div>
							<h3>Tanggapan User</h3>
						</div>

						<!-- tampil koment user -->
						<?php
						$a_user = $koneksi->query("SELECT
						tb_tanggapan_user.id_tanggapan_user,
						tb_tanggapan_user.id_user,
						tb_pengaduan.id_pengaduan,
						tb_user.nama_user,
						tb_user.foto,
						tb_user.kode,
						tb_tanggapan_user.isi_tanggapan_user,
						tb_tanggapan_user.tgl_tanggapan_user
					FROM
						(
							tb_tanggapan_user
						LEFT JOIN tb_pengaduan ON tb_tanggapan_user.id_pengaduan = tb_pengaduan.id_pengaduan
						RIGHT JOIN tb_user ON tb_tanggapan_user.id_user = tb_user.id_user
						)
					WHERE
						tb_tanggapan_user.id_pengaduan = $id ");
						$num = $a_user->num_rows;
						if(@$_SESSION["user"]){
						$users = $_SESSION['user']['kode'];
						}
						while($tb_user = $a_user->fetch_array()){ ?>

							<div class="post_topbar mb-2">
							<div class="usy-dt p-3">
								<?php
							   if ($ta["foto"] != "") {
                                echo "<img src='foto/".$tb_user["foto"]."' width='35' height='35'/>";
							
                        		}else{
                            	echo "<img src='../img/avatar.png' width='35' height='35'/>";
                        		}		
								?>	
								<div class="usy-name">
									<h4 class="mb-1">
										<?php
											echo $tb_user["nama_user"];
										?>
									</h4>
									<span>
										<img src="images/clock.png" alt="">
										<?php
										$date = $tb_user["tgl_tanggapan_user"];
										echo TimeAgo($date, date("Y-m-d H:i:s")); 
										?>
									</span>
									<p class="mt-2"><?php echo $tb_user["isi_tanggapan_user"] ;?></p>
								</div>
							</div>
							<?php if(@$_SESSION["admin"]){ ?>
							<div class="ed-opts" >
							<?php }else{
								if($users == $tb_user["kode"]){ ?>
								<div class="ed-opts">
								 <?php }else{?>
								<div class="ed-opts" hidden >
									
									<?php }?>
							<?php } ?>	
								<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
								<ul class="ed-options">	
								<li><a href="delete-tanggapan.php?id_tanggapan_user=<?php echo $tb_user["id_tanggapan_user"]?>&id= <?php echo $tb_user["id_pengaduan"];?> "  title="">Delete</a></li>
							</div>
						</div>

							<?php } ?>



						<div class="pt-2">
							<h3>Tanggapan Admin</h3>
						</div>
							<!-- tampil koment admin -->
						<?php
						$a_admin = $koneksi->query("SELECT  tb_tanggapan.id_tanggapan,
						tb_tanggapan.id_admin,tb_pengaduan.id_pengaduan,tb_admin.nama_admin,tb_tanggapan.isi_tanggapan,
						tb_tanggapan.tgl_tanggapan					 
						FROM(tb_tanggapan LEFT JOIN tb_pengaduan ON tb_tanggapan.id_pengaduan=
						tb_pengaduan.id_pengaduan
						 RIGHT JOIN tb_admin on tb_tanggapan.id_admin=tb_admin.id_admin) WHERE tb_tanggapan.id_pengaduan  = $id ");
						$num = $a_admin->num_rows;
						while($tb_admin = $a_admin->fetch_array()){ ?>

							<div class="post_topbar">
							<div class="usy-dt p-3">
								<?php
							
								echo "<img src='../img/avatar.png' width='50' height='50'/>";
									
								?>	
								<div class="usy-name">
									<h4 class="mb-1">
										<?php
											echo $tb_admin["nama_admin"];
										?>
									</h4>
									<span>
										<img src="images/clock.png" alt="">
										<?php
										$date = $tb_admin["tgl_tanggapan"];
										echo TimeAgo($date, date("Y-m-d H:i:s")); 
										?>
									</span>
									<p class="mt-2"><?php echo $tb_admin["isi_tanggapan"] ;?></p>
								</div>
							</div>

							<?php if(@$_SESSION["admin"]){ ?>
							<div class="ed-opts" >
							<?php }else{ ?>
							<div class="ed-opts" hidden >
							<?php } ?>	
							
								<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
								<ul class="ed-options">
								<li><a href="delete-tanggapan.php?id_tanggapan_admin=<?php echo $tb_admin["id_tanggapan"]?>&id= <?php echo $tb_admin["id_pengaduan"];?> "  title="">Delete</a></li>
							</div>
						</div>

	

							<?php } ?>
                        </div>
                    </div>
                </div>
                    
			</div><!--post-bar end-->
		
	

    </div> <!--main-wc-sec end-->
</div>
</div>
</div>
</div>
</div>
</main>
<?php include "footer.php"; ?>
