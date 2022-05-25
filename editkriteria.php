<?php
//untuk koneksi ke database
include 'koneksi.php';
if (isset($_POST['submit'])) {
  //proses edit
  $id_krit  = $_POST['id_krit'];
  $kriteria = $_POST['kriteria'];
  $bobot    = $_POST['bobot'];

  $ubah = "UPDATE tab_kriteria SET nama_kriteria ='$kriteria',bobot ='$bobot' WHERE id_kriteria='$id_krit' ";
  $sql = mysqli_query($koneksi, $ubah);
  if ($sql) {
    header("location:kriteria.php?pesan=edit");
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
      <!--form kriteria-->
      <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center">
            Edit Kriteria
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form class="form" action="editkriteria.php" method="POST">
                  <?php
                  //koneksi
                  session_start();
                  include("koneksi.php");
                  //perintah untuk menampilkan hasil edit
                  if (isset($_GET['id_kriteria'])) {
                    $id_krit = $_GET['id_kriteria'];
                    $ambil = "SELECT * FROM tab_kriteria WHERE id_kriteria = '$id_krit' ";
                    $sql = mysqli_query($koneksi, $ambil);
                    foreach ($sql as $data) : ?>
                      <div class="form-group" hidden>
                        <input class="form-control" type="text" name="id_krit" value="<?php echo $data['id_kriteria'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="text" name="kriteria" value="<?php echo $data['nama_kriteria'] ?>">
                      </div>
                      <div class="form-group">
                        <select class="form-control" name="bobot">
                          <option disabled>-- Tingkat Kepentingan Kriteria --</option>
                          <option value="1" <?php echo ($data['bobot'] == '1') ? "selected" : "";?> >Sangat Tidak Penting</option>
                          <option value="2" <?php echo ($data['bobot'] == '2') ? "selected" : "";?> >Tidak Penting</option>
                          <option value="3" <?php echo ($data['bobot'] == '3') ? "selected" : "";?> >Ragu-ragu</option>
                          <option value="4" <?php echo ($data['bobot'] == '4') ? "selected" : "";?> >Penting</option>
                          <option value="5" <?php echo ($data['bobot'] == '5') ? "selected" : "";?> >Sangat Penting</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <a href="kriteria.php"><button type="button" class="btn btn-danger">Batal</button></a>
                        <button type="submit" name="submit" class="btn btn-success">Ubah</button>
                      </div>
                  <?php endforeach;
                  }  ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--form kriteria-->
    </div>
  </div>

  <!--footer-->
  <footer class="text-center">
    <div class="footer-below">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <em></em>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!--plugin-->
  <script src="tampilan/js/bootstrap.min.js"></script>
</body>

</html>