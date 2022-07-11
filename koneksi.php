<?php 
$host = "becik.my.id:3306";
$user = "workshop_zack77";
$pass = "workshop467791zA";
$db = "workshop_";
// ==========================================/
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db = "sovana";
// ==========================================/
$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Koneksi Gagal".mysqli_connect_error());
}else{
    // echo "Koneksi Berhasil";
}