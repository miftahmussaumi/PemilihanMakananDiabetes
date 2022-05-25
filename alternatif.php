<?php
//koneksi
session_start();
include("koneksi.php");

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

  <div class="container">

    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
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
              <?php echo "Alternatif sudah ada !"; ?>
            </div>
          <?php
          } else if ($pesan == "hapus") { ?>
            <div class="alert alert-success">
              <?php echo "Alternatif berhasil DIHAPUS !"; ?>
            </div>
          <?php
          } else if ($pesan == "edit") { ?>
            <div class="alert alert-success">
              <?php echo "Alternatif berhasil DIUBAH !"; ?>
            </div>
        <?php
          }
        } ?>
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            Alternatif
          </div>

          <ul class="nav nav-tabs">
            <li class="active">
              <a href="alternatif.php" data-toggle="tab">Tabel Alternatif</a>
            </li>
            <li>
              <a href="alternatiftambah.php" data-toggle="tab">Tambah Alternatif</a>
            </li>
          </ul>

          <div class="panel-body">
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="">
                <!--tabel alternatif-->
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Makanan</th>
                      <th>Porsi</th>
                      <th>Keterangan</th>
                      <th colspan="2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = $koneksi->query('SELECT * FROM tab_alternatif');
                    $no = 1;
                    while ($row = $sql->fetch_array()) {
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[3] ?></td>
                        <td align="center"><a href="editalternatif.php?id_alternatif=<?php echo $row['id_alternatif'] ?>"><i class="fa fa-edit fa-fw"></i> </td>
                        <td align="center"><a href="hapusalternatif.php?id_alternatif=<?php echo $row['id_alternatif'] ?>"><i class="fa fa-trash fa-fw"></i> </td>
                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
                <!--tabel alternatif-->
              </div>
            </div>
          </div>
          <!--panel body-->
        </div>
      </div>
    </div>

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