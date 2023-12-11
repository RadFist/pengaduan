<?php
include "../config.php";
if(isset($_GET['id_tanggapan_admin'])){
    $id_pengaduan = $_GET['id'];
    $id_tanggapan = $_GET['id_tanggapan_admin'];
    $data = $koneksi ->query("DELETE FROM tb_tanggapan WHERE id_tanggapan = '$id_tanggapan'");
    if($data){
        header("location: tanggapan.php?id=$id_pengaduan");
    }
}else{
    $id_pengaduan = $_GET['id'];
    $id_tanggapan = $_GET['id_tanggapan_user'];
    $data = $koneksi ->query("DELETE FROM tb_tanggapan_user WHERE id_tanggapan_user = '$id_tanggapan'");
    if($data){
        header("location: tanggapan.php?id=$id_pengaduan");
    }
}

?>