<?php 
include 'koneksi.php';
 //fungsi buatRupiah
 function rupiah($angka){
     $hasil = "Rp " . number_format($angka,0,',','.');
     return $hasil;
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
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/swal.js"></script>
    <title>Salary | Karyawan</title>
    <style>
      * {
        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
      }
      .kurung{
        border-radius: 10px;
        padding: 8px;
        box-shadow: 0px 0px 10px 0px rgba(41, 40, 40, 0.5);
        border: 1px solid #3E3E3F;
        background-color: #fff;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .alamat{
        border-radius: 10px;
        padding: 8px;
        font-size: x-small;
    }
    table, th, td{
        font-size: 14px;
        margin-left: auto;
        pading-left: 10px;
    }
    </style>
  </head>
  <body>
    <div class="container-float mt-3">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12">
          <div class="row kurung">
            <H1 class="text-decoration-underline text-center">Slip Gaji Karyawan</H1>
            <label class="col-sm-7 col-form-label px-5">
              <img src="images/logo.jpeg" alt="" width="120px">
              <p>
                <span class="fw-bold"> SOVANA BALI GARMEN</span><br>
                <span class="text-primary"> Jl. Gunung Tangkuban Perahu. Perum BUANA PERMAI. Blok 1/20</span>
              </p>
            </label>
            <div class="col-sm-5 float-end p-5">
              <table >
                <tr>
                  <th>No. Invoice &nbsp;</th>&nbsp; 
                  &nbsp; &nbsp;
                  <td>:&nbsp; &nbsp;</td> 
                  <td><?= Rand(0000010000,0100020100) ?></td>
                </tr>
                <tr>
                  <th>Nama</th>&nbsp; 
                  <td>:</td> 
                  <td id="isiNama">
                  <select class="form-select form-select-lg" style="border: none;">
                    <option selected>Nama Karyawan</option>
                    <option value="Ali mansyur">Ali mansyur</option>
                    <option value="Noor Efendi z">Noor Efendi z</option>
                    <option value="Ny Ariantini">Ny Ariantini</option>
                    <option value="Mas Budi">Mas Budi</option>
                    <option value="Aulia Margareta">Aulia Margareta</option>
                    <option value="Surya Darma">Surya Darma</option>
                    <option value="Sekar">Sekar</option>
                    <option value="Suyoto">Suyoto</option>
                  </select>
                  </td>
                </tr>
                <tr>
                  <th>Jabatan</th>&nbsp; 
                  <td>:</td>&nbsp; &nbsp; 
                  <td>Penjahit</td>
                </tr>
                <tr>
                  <th>Periode</th>&nbsp; 
                  <td>:</td>&nbsp; &nbsp; 
                  <td><?php echo date('M-Y'); ?></td>
                </tr>
              </table>
            </div>
            <table class="table table-sm" id="tbPrint"
              <thead>
                <tr  style="background-color: #A4A4A8D8;">
                  <th>No</th>
                  <th>Customer</th>
                  <th class="col-sm-2">Style</th>
                  <th>Code</th>
                  <th>Size</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                $prnt = mysqli_query($koneksi, "SELECT * FROM salary INNER JOIN produksi ON produksi.id = salary.id_produksi ORDER BY salary.id DESC");
                while($data = mysqli_fetch_array($prnt)){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?= $data['nama_customer'] ?></td>
                  <td><?= $data['style'] ?></td>
                  <td><?= $data['code'] ?></td>
                  <td><?= $data['size'] ?></td>
                  <td><?= $data['cost'] ?></td>
                  <td><?= $data['jumlah']; ?></td>
                  <td><?= rupiah($data['total']) ?></td>
                </tr>
                <input type="hidden" value="<?= $data['nama']; ?>" id='hdNama'>
                <?php } ?>
                </tbody>
              <tfoot>
                <?php 
                $tl = mysqli_query($koneksi, "SELECT SUM(total) AS total FROM salary");
                $data = mysqli_fetch_array($tl);
                ?>
                <tr>
                  <td></td>
                  <th>Hadir  :</th>
                  <th id="hadir">70.000</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <th colspan="1" class="text-right" bold>Sub Total</th>
                  <th><?= rupiah($data['total']) ?></th>
                </tr>
                <tr>
                  <td></td>
                  <th>Lembur  :</th>
                  <th id="lembur">70.000</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <th colspan="1" class="text-right" bold>:</th>
                  <th id="tunjangan">140.000</th>
                </tr>
                <tr>
                  <td></td>
                  <th>Total Tunjangan:</th>
                  <th id="lembur">140.000</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <th colspan="1" class="text-right" bold>Kasbon</th>
                  <th><div id="kasbon"></div></th>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th class="col-sm-2"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Grand Total : </th>
                  <th><?= rupiah($data['total']) ?></th>
              </tfoot>
            </table>
          </div>         
      </div>
      <!-- batas header -->
      <div class="row justify-content-center">
        <div class="col-12">
          
        </div>
      </div>
    </div>
    <script>
      // tbPrint datatables
      $(document).ready(function() {
        $('#tbPrint').DataTable();
        $('#hdNama').val = $('#isiNama').val();
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>