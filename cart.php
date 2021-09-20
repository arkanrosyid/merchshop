<!doctype html>
<html lang="en">
  <head>
    <title>Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .container  {
          padding : 30px;
        }
        i{
          color : white;
        }
      </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php 
include 'navbar.php';
include 'conn.php';

?>

<div class="container"> 
      <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col"></th>
          <th scope="col"> Product </th>
          <th scope="col"> Price </th>
          <th scope="col"> Quantity </th>
          <th scope="col"> Total </th>
        </tr>
      </thead>
      <?php 
      
      if (empty($_SESSION['keranjang'])){
            
        echo "<script>alert('Keranjang Anda Kosong'); </script>";
        echo "<script>location='index.php'; </script>";

        }
        else {
        
        $total_harga = 0;
            // perulangan output keranjang
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):


 

        $hasil = mysqli_query($conn , ("SELECT * FROM barang where id_barang = '$id_produk' "));

        $row = $hasil -> fetch_assoc();
        $harga = $row['harga_barang'] * $jumlah;
        $tambah = $row['id_barang'];
        
    ?>

     
      <tbody>
        <tr>
          <th> <button  class="btn btn-primary" type="submit" ><a href="keranjang_hapus.php?id=<?php echo  $row['id_barang'] ; ?>"><i class="fas fa-times"></i></a></button></th>
          <td><?php echo $row['nama_barang']  ;?></td>
          <td>IDR . <?php echo $row['harga_barang'];?></td>
          <td>
            <div class="action">  
             <button type="submit" class="btn btn-primary" ><a href="min_cart.php?id=<?php echo  $row['id_barang'] ; ?>"> <i class="fas fa-minus "></i></a></button>
             <?php echo $jumlah; ?>
             <button type="submit" class="btn btn-primary" ><a href="add_cart.php?id=<?php echo  $row['id_barang'] ; ?>"> <i class="fas fa-plus"></i></a></button>
           </div> 
           </td>
          <td>IDR . <?php echo $harga;?> </td>
        </tr>
        <?php $total_harga = $total_harga + $harga; ?>

        <?php
              endforeach;
       
    }
      
    


        ?>
        <!-- end loop -->
        <tr>
          <td></td>
          <td colspan="3"> Total</td>
          <td>IDR . <?php echo $total_harga;?></td>
        </tr>
    
      </tbody>
    </table>
      
    
    <div class="btn">
      <button  type="submit" class="btn btn-primary">
      <a href="index.php"> <i class="fas fa-arrow-circle-left"></i> </a>
   
      <button type="submit" class="btn btn-primary" style=" margin-left: 5px;">
      <a href="checkout.php"> <i class="fas fa-shopping-basket"></i></a>
    </button>
    </div>
  
      
 
  </div>





      </body>
</html>