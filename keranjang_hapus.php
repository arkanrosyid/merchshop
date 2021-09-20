<?php 
session_start();
$id_produk = $_GET['id'];

echo $id_produk;
unset($_SESSION['keranjang'][$id_produk]);


echo "<script>alert('Item Berhasil Dihapus'); </script>";
echo "<script>location='cart.php'; </script>";
?>