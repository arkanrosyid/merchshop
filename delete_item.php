<?php

session_start();
include 'conn.php';

$id_barang = $_GET['id'];


$conn->query("DELETE FROM `barang` WHERE id_barang = '$id_barang' ") or die($conn ->error);

echo "<script>alert('Barang Berhasil Dihapus'); </script>";
echo "<script>location='index.php'; </script>";


?>