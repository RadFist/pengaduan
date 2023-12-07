<?php
include "../config.php";
$kode = $_GET["kode"];
$berhasil = $koneksi->query("DELETE FROM tb_user_follow WHERE following='$kode'");
if($berhasil){
    echo "<script>location='index.php';</script>";
}

?>