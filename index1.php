<?php include 'functions.php';
session_start();
if(isset($_POST['save'])){
    if(saveGajian($_POST) > 0){
        $_SESSION['sukses'] = 'Data Berhasil ditambahkan';
        header('Location: index1.php');
    }else{
        $_SESSION['gagal'] = 'Data Gagal ditambahkan';
        header('Location: index1.php');
    }
}
if(isset($_POST['edit'])){
    if(editGajian($_POST) > 0){
        $_SESSION['sukses'] = 'Data Berhasil diubah';
        header('Location: index1.php');
    }else{
        $_SESSION['gagal'] = 'Data Gagal diubah';
        header('Location: index1.php');
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title>Salary | Sampe</title>

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

        <!--  -->
    <?php 
    //fungsi buatRupiah
    function rupiah($angka){
        $hasil = "Rp " . number_format($angka,0,',','.');
        return $hasil;
    }
    function tgl_kita($tanggal) {
        $bulan = array(
            1 =>   'Jan',
            2 =>   'Feb',
            3 =>   'Mar',
            4 =>   'Apr',
            5 =>   'Mei',
            6 =>   'Jun',
            7 =>   'Jul',
            8 =>   'Agu',
            9 =>   'Sep',
            10 =>  'Okt',
            11 =>  'Nov',
            12 =>  'Des'
        );
        $hari = array(
            1 =>   'Sen',
            2 =>   'Sel',
            3 =>   'Rab',
            4 =>   'Kam',
            5 =>   "Jum'",
            6 =>   'Sab',
            7 =>   'Min'
        );
        $tgl = substr($tanggal, 8, 2);
        $bln = substr($tanggal, 5, 2);
        $thn = substr($tanggal, 0, 4);
        $bln = $bulan[(int) $bln];
        $hari = $hari[(int) date('N', strtotime($tanggal))];
        return $hari . ', ' . $tgl . ' ' . $bln . ' ' . $thn;
    }
    if(isset($_GET['h'])) {
        if($_GET['h'] == "ubah") {
        $id = $_GET['id'];
            $sa = mysqli_query($koneksi, "SELECT * FROM harianku WHERE id = '$_GET[id]'");
            $row = mysqli_fetch_assoc($sa);
            if($row) {
                $vcustomer = $row['customer'];
                $vstyle = $row['style'];
                $vjumlah = $row['jumlah'];
                $vwarna = $row['warna'];
                $vketerangan = $row['keterangan'];
                $vtanggal = $row['tanggal'];
                $vgambar = $row['gambar'];
            }
        }
        if($_GET['h'] == "hapus") {
            $id = $_GET['id'];
            $sql = mysqli_query($koneksi, "DELETE FROM gajian WHERE id = '$_GET[id]'");
            if($sql) {
                $_SESSION['sukses'] = 'Data Berhasil dihapus';
                header('Location: index1.php');
            }else{
                $_SESSION['gagal'] = 'Data Gagal dihapus';
                header('Location: index1.php');
            }
        }
    }
    ?>

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
        <a class="nav-link" href="http://localhost:8080/project/index.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cetak.php">Print</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container-fluid mt-5 px-4">
        <div class="row ">
            <div class="col-lg-3 col-sm-12 col-md-12 my-2">
                <div class="card">
                    <div class="card-header">Form Salary</div>
                    <div class="card-body p-3">
                    <form action="" class="form-input text-sm" method="post" enctype="multipart/form-data">
                        <div class="mb-2 row">
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <input type="hidden" class="zoom" name="gambarLama" value="<?= $vgambar; ?>">
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Date <small
                                    class="text-danger float-end"> </small></label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" name="tanggal" style="font-size: small;">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label"style="font-size: small;" >Customer</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" id="customerNya" name="customer"
                                    style="font-size: small;" value="<?= @$vcustomer; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Style</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" name="style"
                                    style="font-size: small;" value="<?= @$vstyle; ?>">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Cost</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" name="harga" id="harga" style="font-size: small;">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Jumlah</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" name="jumlah" id="jumlah" style="font-size: small;">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >New Style</label>
                            <div class="col-sm-7">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="anyar" name="x">
                                <option selected>Sample Baru ?</option>
                                <option value="y">Ya</option>
                                <option value="n">Tidak</option>
                            </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Pattern</label>
                            <div class="col-sm-7">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="patrun" name="patrun">
                                <option selected>Buat Patrun ?</option>
                                <option value="y">Ya</option>
                                <option value="n">Tidak</option>
                            </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" style="font-size: small;" >Total</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-capitalize" name="total" id="total" style="font-size: small;">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-5 col-form-label" id="inputGroup-sizing-sm" style="font-size: small;" >Description</label>
                            <div class="col-sm-7">
                                <textarea class="form-control text-capitalize" rows="3" style="font-size: 11px;"
                                    name="keterangan"><?= @$vketerangan; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="row start-50">
                                <div class="col-6">
                                    <center>
                                        <img src="https://data.becik.my.id/img/<?= $vgambar; ?>" class="img-thumbnail  mb-2" id="tampil1"
                                            onerror="if (this.src != 'images/noimage.jpg') this.src = 'images/noimage.jpg';"
                                            width="100px">
                                        <br>
                                        <input class="form-control form-control-sm" id="img1" type="file" name="gambar" value="<?= $vgambar; ?>">
                                    </center>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center" id="tombol">
                        <button class="btn btn-sm btn-info float-end mx-1" id="update"
                            name="update">Update</button>
                        <button class="btn btn-sm btn-info" id="save" name="save">Save | Tambahkan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <script>
                $('#jumlah').keyup(function () {
                    const jml = $('#jumlah').val();
                    const hrg = $('#harga').val();
                    const total = jml * hrg;
                    document.getElementById('total').value= total
                });
                $('#harga').keyup(function () {
                    const jml = $('#jumlah').val();
                    const hrg = $('#harga').val();
                    const total = jml * hrg;
                    document.getElementById('total').value= total
                });
            </script>
            <!--  -->
            <div class="col-lg-5 col-sm-12 col-md-12 my-2">
                <div class="card">
                    <div class="card-header text-center"> Salary</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm text-white-50" id="tbGajian">
                                <thead>
                                <tr class="text-white">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Customer</th>
                                        <th>Style</th>
                                        <th>Pattern</th>
                                        <th>Cost</th>
                                        <th>New-Sample</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $gaji = mysqli_query($koneksi, "SELECT * FROM gajian ORDER BY id DESC");
                                    $no = 1;
                                    while($row = mysqli_fetch_assoc($gaji)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row ['tanggal']; ?></td>
                                            <td><?= $row['customer'] ; ?></td>
                                            <td><?= $row['style'] ; ?></td>
                                            <td>
                                            <?php 
                                                if ($row['patrun'] == 'y') {
                                                    echo '<i class="fa-solid fa-check-double text-info fs-5"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-x text-danger fs-5"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td><?= rupiah($row['harga']) ; ?></td>
                                            <!-- <td><?= $row['x'] ; ?></td> -->
                                            <td>
                                                <?php 
                                                if ($row['x'] == 'y') {
                                                    echo '<i class="fa-solid fa-check-double text-info fs-5"></i>';
                                                } else {
                                                    echo '<i class="fa-solid fa-x text-danger fs-5"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $row['jumlah'] ; ?></td>
                                            <td><?= rupiah($row['total']) ; ?></td>
                                            <td>
                                                <!-- <img src="https://data.becik.my.id/img/<?= $row['gambar'] ; ?>" class="" width="30px" height="40"> -->
                                                <?php 
                                                // if gambar error maka tampilkan gambar default
                                                if ($row['gambar'] == '') {
                                                    echo '<img src="images/noimage.jpg" class="img-thumbnail" width="30px" height="40">';
                                                } else {
                                                    echo '<img src="https://data.becik.my.id/img/'.$row['gambar'].'" width="30px" height="40">';
                                                }
                                                ?>
                                            </td>
                                            <td class="d-flex">
                                                <a href="index1.php?h=ubah&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square text-info"></i></a>&nbsp; &nbsp
                                                <a href="index1.php?h=hapus&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- kolom diary -->
            <div class="col-lg-4 col-sm-12 col-md-12 my-2">
                <div class="card">
                    <div class="card-header">Salary</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-white-50" id="tbDiary">
                                <thead>
                                    <tr class="text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Customer</th>
                                        <th>Style</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM harianku ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $row['customer'] ?></td>
                                            <td><?= $row['style'] ?></td>
                                            <td class="text-center">
                                                <a href="index1.php?h=ubah&id=<?= $row['id'] ?>" class=""><i class="fa-solid fa-pen-to-square text-info"></i></a>&nbsp; &nbsp;
                                                
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
    




<script src="coba.js"></script>
    <!-- <script src="script.js" ></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/8.18.3/sweetalert2.all.min.js">

</script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>