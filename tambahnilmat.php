<?php
//koneksi
session_start();
include("koneksi.php");
$id_topsis = $_POST['id_topsis'];
$alternatif = $_POST['alter'];
$kriteria   = $_POST['krit'];
$poin       = $_POST['nilai'];

$cek = mysqli_query($koneksi, "SELECT id_kriteria, id_alternatif FROM tab_topsis WHERE id_alternatif ='$alternatif' AND id_kriteria='$kriteria' ");
if ($cek->num_rows > 0) {
  header("location:nilmat.php?pesan=nama_kriteria_sama");
} else {
  $masuk = "INSERT INTO tab_topsis VALUES ('" . $id_topsis . "','" . $alternatif . "','" . $kriteria . "','" . $poin . "')";
  $buat  = $koneksi->query($masuk);
  if ($buat) {
    header("location:nilmat.php?pesan=save");
  }
}

?>
