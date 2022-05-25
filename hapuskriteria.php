<?php
//untuk koneksi ke database
session_start();
include ("koneksi.php");

//proses delete
$id_krit = $_GET['id_kriteria'];
$sql     = "DELETE FROM tab_kriteria WHERE id_kriteria = '$id_krit' ";
$hapus   = $koneksi->query($sql);

if ($hapus) {
  header("location:kriteria.php?pesan=hapus");
} else {
  echo "Maaf Tidak Dapat Menghapus !";
}
?>
