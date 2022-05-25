<?php
//koneksi
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
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
        <a class="navbar-brand" href="#">SPK Metode Topsis</a>
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
            <a href="poin.php">Poin</a>
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
      <div class="col-lg-12">
        <h2>Aplikasi Sistem Penunjang Keputusan Pemilihan Makanan Menggunakan Metode Topsis</h2>
        <p>Aplikasi ini dirancang untuk membantu dalam mengambil keputusan untuk pemilihan makananan yang tepat bagi
          penderita diabetes
        </p> <br><br>
        <h4>Kelompok 9 :</h4>
        <p>
        <ul>
          <li>Miftah Mussaumi Adi (1911522009)</li>
          <li>Dhiya Nabila Denta (1911523021)</li>
          <li>Farras Naufal Suhanda (2011523005)</li>
          <li>Hanif Izza Pratama (2011521023)</li>
        </ul>
        </p>
      </div>
    </div>
  </div>


  <!--plugin-->
  <script src="tampilan/js/bootstrap.min.js"></script>

</body>

</html>