<?php
//koneksi
session_start();
include("koneksi.php");
//pemberian kode id secara otomatis
$carikode = $koneksi->query("SELECT id_alternatif FROM tab_alternatif") or die(mysqli_error());
$datakode = $carikode->fetch_array();
$jumlah_data = mysqli_num_rows($carikode);

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

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            Alternatif
          </div>

          <ul class="nav nav-tabs">
            <li>
              <a href="alternatif.php" data-toggle="tab">Tabel Alternatif</a>
            </li>
            <li class="active">
              <a href="alternatiftambah.php" data-toggle="tab">Tambah Alternatif</a>
            </li>
          </ul>

          <div class="panel-body">
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="">
                <!--form alternatif-->
                <form class="form" action="alternatiftambah.php" method="post">
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id_alter" value="<?php echo $kode_otomatis ?>">
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" name="nm_alter" placeholder="Nama Makanan">
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" name="porsi" placeholder="Porsi (satuan gram, buah, dll)">
                  </div>
                  <div class="form-group">
                    <em>*opsional</em>
                    <textarea class="form-control" type="text" name="keterangan" placeholder="Keterangan"></textarea>
                  </div>
                  <div class="form-group">
                    <input class="btn btn-success" type="submit" name="simpan" value="Tambah">
                  </div>
                </form>
                <!--form alternatif-->
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

  <?php
  if (isset($_POST['simpan'])) {
    $id_alter = $_POST['id_alter'];
    $alternatif = $_POST['nm_alter'];
    $porsi = $_POST['porsi'];
    $keterangan = $_POST['keterangan'];

    $cek = mysqli_query($koneksi, "SELECT nama_alternatif FROM tab_alternatif WHERE nama_alternatif ='$alternatif'");
    if ($cek->num_rows > 0) {
      header("location:alternatif.php?pesan=nama_kriteria_sama");
    } else {
      $masuk = "INSERT INTO tab_alternatif VALUES ('$id_alter','$alternatif','$porsi','$keterangan')";
      $buat  = $koneksi->query($masuk);
      if ($buat) {
        header("location:alternatif.php?pesan=save");
      }
    }
  }
  ?>

  <!--plugin-->
  <script src="tampilan/js/bootstrap.min.js"></script>

</body>

</html>