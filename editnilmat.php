<?php
//koneksi
session_start();
include("koneksi.php");
if (isset($_POST['submit'])) {
    //proses edit
    $id_topsis = $_POST['id_topsis'];
    $poin       = $_POST['nilai'];

    $ubah = "UPDATE tab_topsis SET nilai='$poin' WHERE id_topsis ='" . $id_topsis . "' ";
    $sql = mysqli_query($koneksi, $ubah);
    if ($sql) {
        header("location:nilmat.php?pesan=edit");
    } else {
        echo "<script>window.location.href = \"nilmat.php\" </script>";
    }
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
                                        Edit Penilaian
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form class="form" action="editnilmat.php" method="post">
                                                    <?php
                                                    //perintah untuk menampilkan hasil edit
                                                    if (isset($_GET['id_topsis'])) {
                                                        $id_topsis = $_GET['id_topsis'];
                                                        $ambil = "SELECT * FROM tab_topsis
                                                                                                JOIN tab_alternatif ON tab_topsis.id_alternatif=tab_alternatif.id_alternatif
                                                                                                JOIN tab_kriteria ON tab_topsis.id_kriteria=tab_kriteria.id_kriteria 
                                                                                                WHERE id_topsis = '$id_topsis' ";
                                                        $sql = mysqli_query($koneksi, $ambil);
                                                        foreach ($sql as $data) : ?>
                                                            <div class="form-group" hidden>
                                                                <input class="form-control" type="text" name="id_topsis" value="<?php echo $data['id_topsis'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="id_alternatif" value="<?php echo $data['nama_alternatif'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="id_kriteria" value="<?php echo $data['nama_kriteria'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <select class="form-control" name="nilai">
                                                                    <option disabled>-- Tingkat Kepentingan Kriteria --</option>
                                                                    <option value="1" <?php echo ($data['nilai'] == '1') ? "selected" : ""; ?>>(1) Sangat Tidak Penting</option>
                                                                    <option value="2" <?php echo ($data['nilai'] == '2') ? "selected" : ""; ?>>(2) Tidak Penting</option>
                                                                    <option value="3" <?php echo ($data['nilai'] == '3') ? "selected" : ""; ?>>(3) Ragu-ragu</option>
                                                                    <option value="4" <?php echo ($data['nilai'] == '4') ? "selected" : ""; ?>>(4) Penting</option>
                                                                    <option value="5" <?php echo ($data['nilai'] == '5') ? "selected" : ""; ?>>(5) Sangat Penting</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <a href="nilmat.php"><button type="button" class="btn btn-danger">Batal</button></a>
                                                                <button type="submit" name="submit" class="btn btn-success">Ubah</button>
                                                            </div>
                                                    <?php endforeach;
                                                    }  ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
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
                                                            <a href="editkriteria.php?id_topsis=<?php echo $row['id_topsis'] ?>"> <i class="fa fa-edit fa-fw"></i>
                                                        </td>
                                                        <td align="center">
                                                            <a href="hapuskriteria.php?id_kriteria=<?php echo $row['id_kriteria'] ?>"> <i class="fa fa-trash fa-fw"></i>
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
        <!--row-->
    </div>
    <!--container-->

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