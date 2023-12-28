<?php 
include "../config.php";
$id = $_GET['id'];
$select = $koneksi->query("SELECT * FROM tb_pengaduan WHERE id_pengaduan = '$id'");
$hasilselect =$select->fetch_array();
$foto_sebelum = $hasilselect["gambar_pengaduan"];
$fotocheck = $koneksi->query("SELECT gambar_pengaduan FROM tb_pengaduan WHERE gambar_pengaduan = '$foto_sebelum'");
$fotocheck = $fotocheck->num_rows;

if($hasilselect["gambar_pengaduan"]!=""){
    $data2 = $koneksi ->query("DELETE FROM tb_tanggapan WHERE id_pengaduan = '$id'");
    $data3 = $koneksi ->query("DELETE FROM tb_tanggapan_user WHERE id_pengaduan = '$id'");
    $data = $koneksi ->query("DELETE FROM tb_pengaduan WHERE id_pengaduan = '$id'");
    if($fotocheck == 1){
        unlink("foto/".$hasilselect['gambar_pengaduan']."");
    }
        echo "<script>location='index.php';</script>";
    
}else{
    $data2 = $koneksi ->query("DELETE FROM tb_tanggapan WHERE id_pengaduan = '$id'");
    $data3 = $koneksi ->query("DELETE FROM tb_tanggapan_user WHERE id_pengaduan = '$id'");
    $data = $koneksi ->query("DELETE FROM tb_pengaduan WHERE id_pengaduan = '$id'");
    if($data){
        echo "<script>location='index.php';</script>";
    }
}
if($data){
    echo "<script>location='index.php';</script>";

}
?>