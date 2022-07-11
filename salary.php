<?php 
session_start();
include 'functions.php';
if(isset($_POST['simpan'])){
    if(saveSalary($_POST) > 0){
        $_SESSION['sukses'] = 'Data Berhasil Disimpan';
        header('Location: salary.php');
    }else{
        $_SESSION['gagal'] = 'Data Gagal Disimpan';
        header('Location: salary.php');
    }
}
if(isset($_Get['hapusSalary'])){
    if(delSalary($_Get) > 0){
        $_SESSION['sukses'] = 'Data Berhasil Dihapus';
        header('Location: salary.php');
    }else{
        $_SESSION['gagal'] = 'Data Gagal Dihapus';
        header('Location: salary.php');
    }
}

?>
<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Salary| Project</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/swal.css">
        <link rel="stylesheet" href="css/style2.css">
        <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
        <script src="js/jquery-3.5.1.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap5.min.js"></script>
        <script src="js/swal.js"></script>
</head>


<body>
<?php if(@$_SESSION['sukses']){ ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $_SESSION['sukses']; ?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    <?php unset($_SESSION['sukses']); ?>
<?php } ?>
<?php if(@$_SESSION['gagal']){ ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?= $_SESSION['gagal']; ?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    <?php unset($_SESSION['gagal']); ?>
<?php } ?>

        <!--  -->
<?php 
if(isset($_GET['p'])) {
    if($_GET['p'] == "edit") {
        $id = $_GET['id'];
        $pro = mysqli_query($koneksi, "SELECT * FROM produksi WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($pro);
        if($data) {
            $pid = $data['id'];
            $pcustomer = $data['nama_customer'];
            $pstyle = $data['style'];
            $pcode = $data['code'];
            $pwarna = $data['warna'];
            $pharga = $data['harga'];
            $pjahit = $data['jahit'];
            $pmotong = $data['motong'];
            $pqty = $data['qty'];
            $pnaskat = $data['naskat'];
            $pgambar = $data['gambar'];
        }
    }

}
function delSalary($id){
    global $koneksi;
    $id = $_GET['id'];
    $sql = "DELETE FROM salary WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);
    return $query;
}

?>
        <!--  -->
<nav class="navbar navbar-sm navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="salary.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cetak.php">Print</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="content mt-3 justify-content-center">
        <div class="row">
            <div class="col-lg-3 col-sm-12 p-3">
                <div class="card">
                    <div class="card-header">Form Gajian </div>
                    <div class="card-body">
                        <form action="salary.php" method="post">
                        <div class="mb-2 row ">
                            <input type="hidden" name="id_produksi" value="<?= $pid; ?>">
                            <input type="hidden" id="harga" value="<?= $pharga; ?>">
                            <input type="hidden" id="jahit" value="<?= $pjahit; ?>">
                            <input type="hidden" id="motong" value="<?= $pmotong; ?>">
                            <input type="hidden" id="naskat" value="<?= $pnaskat; ?>">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Nama </label>
                            <div class="col-sm-7">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="nama" name="nama">
                                <option selected></option>
                                <option value="Noor Efendi za">Noor Efendi za</option>
                                <option value="Ali Mansyur">Ali Mansyur</option>
                                <option value="Nyoman Ariantini">Nyoman Ariantini</option>
                                <option value="Budi">Budi</option>
                                <option value="Aulia Margareta">Aulia Margareta</option>
                                <option value="Surya Darma">Surya Darma</option>
                            </select>
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Tanggal</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="periode" name="periode"
                                    style="font-size: small;" value ="<?php echo date('d-M-Y'); ?>">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Customer</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="customer" name="customer"
                                    style="font-size: small;" value="<?= @$pcustomer; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Style</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="style" name="style"
                                    style="font-size: small;" value="<?= @$pstyle; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Code</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="code" name="code"
                                    style="font-size: small;" value="<?= @$pcode; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Warna</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="warna" name="warna"
                                    style="font-size: small;" value="<?= @$pwarna; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Cost</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="cost" name="cost" style="font-size: small;">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Size</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="size" name="size"
                                    style="font-size: small;">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Jumlah</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="qty" name="jumlah"
                                    style="font-size: small;" value="<?= @$pqty; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row ">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Total</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="total" name="total"
                                    style="font-size: small;">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-2 row justify-content-center ">
                            <img src="https://data.becik.my.id/img/<?= $pgambar; ?>" alt="gambar" id="gambar" style=" height: 120px; width: 100px;">
                        </div><hr>
                        <div class="mb-2 row justify-content-end px-5">
                        <button type=" " class="btn btn-sm btn-danger mb-2" id="pesan">Nama masih Kosong</button>
                            <button type="submit" class="btn btn-sm btn-outline-info" name="simpan" id="simpan">Simpan | Tambahkan </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <script>
                
            </script>
            <!-- kolom -->
            <div class="col-lg-4 col-sm-12 p-3">
                <div class="card">
                    <div class="card-header">Data Produksi</div>
                    <div class="card-body">
                        <table class="table table-sm table-hover" id="tbProduksi">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Customer</th>
                                    <th>Style</th>
                                    <th>Code</th>
                                    <th>Warna</th>
                                    <th>image</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $produksi = mysqli_query($koneksi, "SELECT * FROM produksi ORDER BY id DESC");
                                $no = 1;
                                while($row = mysqli_fetch_assoc($produksi)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_customer'] ?></td>
                                    <td><?= $row['style'] ?></td>
                                    <td><?= $row['code'] ?></td>
                                    <td><?= $row['warna'] ?></td>
                                    <td><img src="https://data.becik.my.id/img/<?= $row['gambar'] ?>" alt="" width="30"
                                            class="img-zoom"></td>
                                    <td>
                                        <a href="salary.php?p=edit&id=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square text-info"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- kolom -->
            <div class="col-lg-5 col-sm-12 p-3">
                <div class="card">
                    <div class="card-header">Data Gaji</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover" id="tbSalary">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Customer</th>
                                        <th>Style</th>
                                        <th>Code</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // inner join untuk mengambil data dari 2 tabel yang ada di database (produksi dan salary)
                                    $salary = mysqli_query($koneksi, "SELECT * FROM salary INNER JOIN produksi ON produksi.id = salary.id_produksi ORDER BY salary.id DESC");
                                    

                                    $no = 1;
                                    while($row = mysqli_fetch_assoc($salary)) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_customer'] ?></td>
                                        <td><?= $row['style'] ?></td>
                                        <td><?= $row['code'] ?></td>
                                        <td><?= $row['jumlah']; ?></td>
                                        <td><?= $row['total'] ?></td>
                                        <td>
                                            <?php 
                                            $sal = mysqli_query($koneksi, "SELECT * FROM salary");
                                            $data = mysqli_fetch_assoc($sal);
                                            ?>
                                            <button class="btn btn-sm btn-danger" name="hapusSalary"><i class="fa-solid fa-trash-can"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/8.18.3/sweetalert2.all.min.js">
        
        </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
    