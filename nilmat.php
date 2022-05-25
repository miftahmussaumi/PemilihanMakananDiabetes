<?php
//koneksi
session_start();
include("koneksi.php");

//pemberian kode id secara otomatis
$carikode = $koneksi->query("SELECT max(id_topsis) FROM tab_topsis") or die(mysqli_error());
$datakode = $carikode->fetch_array();
$jumlah_data = $datakode[0];

if ($datakode) {
  $nilaikode = substr($jumlah_data[0], 1);
  $kode = (int) $nilaikode;
  $kode = $jumlah_data + 1;
  $kode_otomatis = str_pad($kode, 0, STR_PAD_LEFT);
} else {
  $kode_otomatis = "1";
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SPK TOPSIS</title>
  <!--bootstrap-->
  <link href="tampilan/css/bootstrap.min.css" rel="stylesheet">
  <!--icon-->
  <link href="tampilan/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

  <!--menu-->
  <nav class="navbar navbar-default navbar-custom">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">SPK Metode Topsis</a>
      </div>

      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="kriteria.php">Kriteria</a>
          </li>
          <li>
            <a href="alternatif.php">Alternatif</a>
          </li>
          <li>
            <a href="nilmat.php">Nilai Matriks</a>
          </li>
          <li>
            <a href="hastop.php">Proses Topsis</a>
          </li>
          <li>
            <a href="hastopakhir.php">Hasil Akhir Topsis</a>
          </li>
          <li>
            <a href="logout.php"><b>Logout</b></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--tabel-tabel dan form-->
  <div class="container">
    <!--container-->
    <div class="row">
      <!--row-->
      <div class="col-lg-12">
        <?php if (isset($_GET['pesan'])) { ?>
          <?php
          $pesan = $_GET['pesan'];
          if ($pesan == "save") {
          ?>
            <div class="alert alert-success">
              <?php echo "Data berhasil DISIMPAN !"; ?>
            </div>
          <?php
          } else if ($pesan == "nama_kriteria_sama") { ?>
            <div class="alert alert-danger">
              <?php echo "Data Penilaian Alternatif untuk Kriteria sudah ada !"; ?>
            </div>
          <?php
          } else if ($pesan == "hapus") { ?>
            <div class="alert alert-success">
              <?php echo "Data Penilaian berhasil DIHAPUS !"; ?>
            </div>
          <?php
          } else if ($pesan == "edit") { ?>
            <div class="alert alert-success">
              <?php echo "Data Penilaian berhasil DIUBAH !"; ?>
            </div>
        <?php
          }
        } ?>


        <div class="panel panel-default">
          <div class="panel-heading text-center">
            Nilai Matriks
          </div>

          <div class="panel-body">
            <!--form pengisian-->
            <div class="row">
              <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading text-center">
                    Alternatif
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <form class="form" action="tambahnilmat.php" method="post">
                          <div class="form-group" hidden>
                            <input class="form-control" type="text" name="id_topsis" value="<?php echo $kode_otomatis; ?>" readonly>
                          </div>
                          <div class="form-group">
                            <select class="form-control" name="alter">
                              <option selected disabled>-- Nama Alternatif --</option>
                              <?php
                              //ambil data dari database
                              $nama = $koneksi->query('SELECT * FROM tab_alternatif ORDER BY nama_alternatif');
                              while ($datalter = $nama->fetch_array()) {
                                echo "<option value=\"$datalter[id_alternatif]\">$datalter[nama_alternatif]</option>\n";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control" name="krit">
                              <option selected disabled>-- Nama Kriteria --</option>
                              <?php
                              //ambil data dari database
                              $krit = $koneksi->query('SELECT * FROM tab_kriteria ORDER BY nama_kriteria');
                              while ($datakrit = $krit->fetch_array()) {
                                echo "<option value=\"$datakrit[id_kriteria]\">$datakrit[nama_kriteria]</option>\n";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control" name="nilai">
                              <option selected disabled>-- Tingkat Kepentingan Kriteria --</option>
                              <option value="1">(1) Sangat Tidak Penting </option>
                              <option value="2">(2) Tidak Penting</option>
                              <option value="3">(3) Ragu-ragu</option>
                              <option value="4">(4) Penting</option>
                              <option value="5">(5) Sangat Penting</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-success">Proses</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-md-9">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Tabel Pemberian Nilai
                  </div>

                  <div class="panel-body">
                    <?php
                    //pemanggilan data, matra dan pangkat
                    $sql = $koneksi->query("SELECT * FROM tab_topsis
                                            JOIN tab_alternatif ON tab_topsis.id_alternatif=tab_alternatif.id_alternatif
                                            JOIN tab_kriteria ON tab_topsis.id_kriteria=tab_kriteria.id_kriteria") or die(mysql_error());
                    ?>
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Makanan</th>
                          <th>Nama Kriteria</th>
                          <th>Nilai</th>
                          <th colspan="2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        //menampilkan data
                        while ($row = $sql->fetch_array()) {
                          $nmkriteria   = $row['nama_kriteria']; ?>
                          <tr>
                            <td align="center"><?php echo $no++ ?></td>
                            <td align="left"><?php echo $row['nama_alternatif'] ?></td>
                            <td align="left"><?php echo $nmkriteria ?></td>
                            <td align="left"><?php echo $row['nilai'] ?></td>
                            <td align="center">
                              <a href="editnilmat.php?id_topsis=<?php echo $row['id_topsis'] ?>"> <i class="fa fa-edit fa-fw"></i>
                            </td>
                            <td align="center">
                              <a href="hapusnilmat.php?id_topsis=<?php echo $row['id_topsis'] ?>"> <i class="fa fa-trash fa-fw"></i>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--row-->
  </div>

  <!--footer-->
  <footer class="text-center">
    <div class="footer-below">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <em>Kelompok 9</em>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!--plugin-->
  <script src="tampilan/js/bootstrap.min.js"></script>

</body>

</html>