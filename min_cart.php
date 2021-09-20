<?php 

session_start();

$id_barang = $_GET['id'];

if (isset($_SESSION['keranjang'][$id_barang]))
{
    if ( $_SESSION['keranjang'][$id_barang] == 0)
{
    echo "<script>location='cart.php'; </script>";
}
else {
  $_SESSION['keranjang'][$id_barang] -= 1;
    }

}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";


echo "<script>alert('produk telah dikurangi dari keranjang belanja'); </script>";
echo "<script>location='cart.php'; </script>";

?>
