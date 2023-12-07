<?php 
include "../config.php";
$id = $_GET['id'];
$select = $koneksi->query("SELECT * FROM tb_pengaduan");
$hasilselect =$select->fetch_array();
if($hasilselect["gambar_pengaduan"]!=""){
    $data = $koneksi ->query("DELETE FROM tb_pengaduan WHERE id_pengaduan = '$id'");
    if($data){
        unlink("foto/".$hasilselect['gambar_pengaduan']."");
        echo "<script>location='index.php';</script>";
    }
}else{
    $data = $koneksi ->query("DELETE FROM tb_pengaduan WHERE id_pengaduan = '$id'");
    if($data){
        echo "<script>location='index.php';</script>";
    }
}
if($data){
    echo "<script>location='index.php';</script>";

}
?>