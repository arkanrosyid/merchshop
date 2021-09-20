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

$email = $_SESSION['email'];


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
      
      if ($_SESSION['keranjang']==''){
            
        echo "<script>alert('Keranjang Anda Kosong'); </script>";
        echo "<script>location='index.php'; </script>";

        }
        else {
        
        $total_harga = 0;
            // perulangan output keranjang
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):


 

        $hasil = mysqli_query($conn , ("SELECT * FROM barang where id_barang = '$id_produk' "));

        $row = $hasil -> fetch_assoc();
        $harga = $row['harga_barang'] *$jumlah;
        $tambah = $row['id_barang'];
        
    ?>

     
      <tbody>
        <tr>
          <th> <button type="submit" class="btn btn-primary" ><a href=""><i class="fas fa-times"></i></a></button></th>
          <td><?php echo $row['nama_barang']  ;?></td>
          <td>IDR . <?php echo $row['harga_barang'];?></td>
          <td>
            <div class="action">  
             <button  class="btn btn-primary"  ><a href=""> <i class="fas fa-minus "></i></a></button>
             1
             <button  class="btn btn-primary" ><a href=""> <i class="fas fa-plus"></i></a></button>
           </div> 
           </td>
          <td>IDR . <?php echo $harga;?> </td>
        </tr>
        <?php $total_harga = $total_harga + $harga ?>

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
      

    <form action="" method="post">
        
        <select name ="id_ongkir" id="d_ongkir">
        <option >Pilih Ongkos Kirim</option>
        <?php 
            $hasil = mysqli_query($conn , ("SELECT * FROM ongkir "));
            while ($ongkir = $hasil -> fetch_assoc()){
                ?>
            <option  value= <?php echo $ongkir['id_ongkir'] ;?> > <?php
                echo "Kota " . $ongkir['kota'];
                echo " Harga : " .$ongkir['harga']; 
                ?></option>
            
                <?php
            }
        
        ?>
 </select>
 <div>
<button  class="btn btn-primary"  type="submit"  name ='checkout' style="margin : 10px;">  <i class="fas fa-shopping-basket"></i>checkout</button>
</div>


    </form>
 
  </div>





      </body>
</html>

<?php 

if (isset($email)){

if (isset($_POST['checkout']))
{
    if ($_POST['id_ongkir'] == 'Pilih Ongkos Kirim'){

        echo "<script>alert('Pilih Ongkir Dahulu'); </script>";
        
    }else {
    
        $hasil2 = mysqli_query($conn , ("SELECT * FROM user where email = '$email' "));
        $row2 = $hasil2 -> fetch_assoc();
      
        
        $id_pelanggan = $row2['id'] ;
        $id_ongkir = $_POST['id_ongkir'];
        $tanggal_beli = date('Y-m-d');

        $hasil3 = mysqli_query($conn , ("SELECT * FROM ongkir where id_ongkir = '$id_ongkir' "));
        $row3 = $hasil3 -> fetch_assoc();

        $total_beli = $total_harga + $row3['harga'];

        $conn -> query ("INSERT INTO pembelian (id_user , id_ongkir, tanggal_beli, total_beli) VALUES ('$id_pelanggan' , '$id_ongkir' , '$tanggal_beli' , '$total_beli' )");
        $id_pembelian_barusan = $conn ->insert_id;

        $conn->query ("INSERT INTO `status_bayar` ( `id_pembelian`, `status`) VALUES ('$id_pembelian_barusan','NOT PAID YET') ");


        foreach ($_SESSION['keranjang'] as $id_produk  =>$jumlah )
        
        {
            $conn->query ("INSERT INTO `pembelian_produk` ( `id_pembelian`, `id_barang`, `jumlah`) VALUES ('$id_pembelian_barusan','$id_produk','$jumlah') ");


        }

       

        echo "<script>alert('Checkout Berhasil'); </script>";
                echo "<script>location='nota.php?id=".$id_pembelian_barusan ." '; </script>";
            
            

            unset($_SESSION["keranjang"]);
        }

     }
}
    else {

    echo "<script>alert('Anda Harus Login Terlebih Dauhulu'); </script>";
    echo "<script>location='cart.php'; </script>";

    }

?>