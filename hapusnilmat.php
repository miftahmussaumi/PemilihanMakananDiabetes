<?php
//untuk koneksi ke database
session_start();
include ("koneksi.php");

//proses delete
$id_topsis = $_GET['id_topsis'];
$sql     = "DELETE FROM tab_topsis WHERE id_topsis = '$id_topsis' ";
$hapus   = $koneksi->query($sql);

if ($hapus) {
    header("location:nilmat.php?pesan=hapus");
} else {
    echo "Maaf Tidak Dapat Menghapus !";
}
