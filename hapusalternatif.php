<?php
//untuk koneksi ke database
session_start();
include ("koneksi.php");

//proses delete
$id_alter = $_GET['id_alternatif'];
$sql   = "DELETE FROM tab_alternatif WHERE id_alternatif = '$id_alter' ";
$hapus = $koneksi->query($sql);

if ($hapus === TRUE) {
  header("location:alternatif.php?pesan=hapus");
} else {
  echo "Maaf Tidak Dapat Menghapus !";
}

?>
