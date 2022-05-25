<?php
//koneksi
session_start();
include("koneksi.php");
$id_alter   = $_GET['id_alternatif'];
$alternatif = $koneksi->query("SELECT * FROM tab_alternatif WHERE id_alternatif = '" . $id_alter . "'");
while ($row = $alternatif->fetch_row()) {
  $nama  = $row[1];
  $porsi = $row[2];
  $ket   = $row[3];
}

if (isset($_POST['submit'])) {
  //proses edit
  $alternatif = $_POST['nm_alter'];
  $porsi = $_POST['porsi'];
  $ket = $_POST['keterangan'];

  $ubah = "UPDATE tab_alternatif SET nama_alternatif='$alternatif',porsi='$porsi',keterangan='$ket' WHERE id_alternatif ='" . $id . "' ";
  $sql = mysqli_query($koneksi, $ubah);
  if ($sql) {
    header("location:alternatif.php?pesan=edit");
  } else {
    echo "<script>window.location.href = \"kriteria.php\" </script>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Metode Topsis</title>
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
        <a class="navbar-brand" href="index.php">SPK Metode Topsis</a>
      </div>

      <div class="collapse navbar-collapse">

      </div>
    </div>
  </nav>

  <div class="container">

    <div class="row">
      <!--form alternatif-->
      <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            Edit Alternatif
          </div>

          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form class="form" action="editalternatif.php" method="post">
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id" value=<?php echo $_GET['id_alternatif']; ?> readonly>
                  </div>
                  <table>
                    <tr>
                      <td width="150px" height="50px">Nama Makanan</td>
                      <td><input class="form-control" type="text" name="nm_alter" placeholder="Nama Makanan" value="<?php echo $nama; ?>"></td>
                    </tr>
                    <tr>
                      <td  width="150px" height="50px">Porsi</td>
                      <td><input class="form-control" type="text" name="porsi" placeholder="Nama Makanan" value="<?php echo $porsi; ?>"></td>
                    </tr>
                    <tr>
                      <td  width="150px" height="50px">Keterangan</td>
                      <td><textarea class="form-control" type="text" name="keterangan" placeholder="Keterangan"><?php echo $ket; ?></textarea></td>
                    </tr>
                  </table>
                  <div class="form-group">
                    <a href="alternatif.php"><button type="button" class="btn btn-danger">Batal</button></a>
                    <button type="submit" name="submit" class="btn btn-success">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--form alternatif-->

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