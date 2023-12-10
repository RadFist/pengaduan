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
                        <div class="post_comment_sec ml-4">
                            <form action="" method="POST">
                                <textarea name="komen"></textarea>
                                <button type="submit">SEND</button>
                            </form>
                            <!-- terakhir disini comment -->
                        <?php      
                        $tz ='Asia/Jakarta';
                        $dt	= new DateTime("now", new DateTimezone($tz));
                        $date = $dt->format('Y-m-d G:i:s'); 

                        if(@$_SESSION["admin"]){
                        $id_admin = $tampil["id_admin"];
                        $id_pengaduan= $ta['id_pengaduan'];
                        $koment= $_POST['komen'];
                            
                            
                        $koneksi->query("INSERT INTO tb_tanggapan VALUES('','$id_admin','$id_pengaduan','$koment','$date')");
                        }
                        ?>
                        </div>
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
