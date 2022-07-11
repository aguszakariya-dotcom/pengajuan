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

    // Path: functions.php
    function query($query){
        global $koneksi;
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
    function saveGajian($data){
        global $koneksi;
        $tanggal = htmlspecialchars($data['tanggal']);
        $customer = htmlspecialchars($data['customer']);
        $style = htmlspecialchars($data['style']);
        $patrun = htmlspecialchars($data['patrun']);
        $harga = htmlspecialchars($data['harga']);
        $x = $data['x'];
        $jumlah = htmlspecialchars($data['jumlah']);
        $total = htmlspecialchars($data['total']);
        $gambarLama = htmlspecialchars($data['gambarLama']);        
        $keterangan = htmlspecialchars($data['keterangan']);
        $query = "INSERT INTO gajian VALUES('','$tanggal','$customer','$style','$patrun','$harga','$x','$jumlah','$total','$gambarLama','$keterangan')";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    function editGajian($data){
        global $koneksi;
        $id = htmlspecialchars($data['id']);
        $tanggal = htmlspecialchars($data['tanggal']);
        $customer = htmlspecialchars($data['customer']);
        $style = htmlspecialchars($data['style']);
        $patrun = htmlspecialchars($data['patrun']);
        $harga = htmlspecialchars($data['harga']);
        $x = $data['x'];
        $jumlah = htmlspecialchars($data['jumlah']);
        $total = htmlspecialchars($data['total']);
        $gambarLama = htmlspecialchars($data['gambarLama']);
        $keterangan = htmlspecialchars($data['keterangan']);
        $query = "UPDATE gajian SET tanggal = '$tanggal', customer = '$customer', style = '$style', patrun = '$patrun', harga = '$harga', x = '$x', jumlah = '$jumlah', total = '$total', gambar = '$gambar', keterangan = '$keterangan' WHERE id = '$id'";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
function saveSalary($data){
    global $koneksi;
    $nama = htmlspecialchars($data['nama']);
    $periode = htmlspecialchars($data['periode']);
    $id_produksi = htmlspecialchars($data['id_produksi']);
    $size = htmlspecialchars($data['size']);
    $cost = htmlspecialchars($data['cost']);
    $qty = htmlspecialchars($data['jumlah']);
    $total = htmlspecialchars($data['total']);

    $query = "INSERT INTO salary VALUES('','$nama','$periode','$id_produksi','$size','$cost','$qty','$total')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

