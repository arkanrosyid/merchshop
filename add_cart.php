<?php 

session_start();

$id_barang = $_GET['id'];

if (isset($_SESSION['keranjang'][$id_barang]))
{
  $_SESSION['keranjang'][$id_barang] += 1;

}
else 
{
  $_SESSION['keranjang'][$id_barang] = 1;
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";


echo "<script>alert('produk telah masuk keranjang belanja'); </script>";
echo "<script>location='cart.php'; </script>";

?>
