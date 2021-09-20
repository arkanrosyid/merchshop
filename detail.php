<!doctype html>
<html lang="en">
  <head>
    <title>Detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
            .container{
                margin-top : 80px;
  
}
.isi {
  height : 600px;
  width : 1000px;
  background-color : #EDEDED;
  float : left;
  
}

.foto {
  float : left;
  background-color : whitesmoke;
  height : 300px;
  width : 300px;
}

.detail {
  float : right;
  text-align : center;
    height : 460px;
    width : 600px;
   background-color : whitesmoke;
  margin : 20px;
}
 h2 {
font-style: normal;
font-weight: bold;
font-size: 36px;
line-height: 42px;
text-align: center;

color: #000000;
}
.cart{  
  float : left;
  background-color : whitesmoke;
  height : 200px;
  width : 200px;
  margin : 20px;
}
p{
  word-wrap: break-word;
  padding : 5px;
  text-align : left;
}
.cart {
  text-align : center;
  background-color : #EDEDED, 100%;
}
.tag{
  float : left;
  margin: 50px;
  text-align : justify;
   
}


.kotak {
  float : left;
  height : 450px;
  width : 300px;
  margin : 20px;
  position : relative;
  text-align : center;
 
  
}
h3 {
    font-style: normal;
font-weight: normal;
font-size: 36px;
line-height: 42px;
text-align: center;

color: #FF6767;


}
small a{
    font-style: normal;
font-weight: normal;
line-height: 28px;
text-align: center;

color: #000000;

}
small a:hover {
    color: #000000;
    
}
.header {
    height : 50px;
    width : 100%;
    background-color : #C4C4C4;
}
i{
          color : white;
        }

    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <?php 
  include('navbar.php');

  

  include 'conn.php';

  
  $id_barang = $_GET['id'];

  $hasil = mysqli_query($conn , ("SELECT * FROM barang where id_barang = '$id_barang' "));
       
  while ($row = mysqli_fetch_array ($hasil)) {

    echo '<div class="container">
    <div class="isi">
    
    <div class="kotak"> ';
    echo '<div class="foto">
    <div style=" height: 300px;">
    <img src="data:image/jpeg;base64,'. base64_encode( $row['file'] ). '" alt="" style="max-width : 300px; ; max-height : 300px ;">
    </div>
';


echo ' 
<div style="margin : 20px;" >
<h2>'.$row['nama_barang'] .'</h2>';

$id_kategori = $row['id_kategori'];
$kategori = mysqli_query($conn , ("SELECT * FROM kategori_barang where id_kategori= '$id_kategori' "));

while ($kat = mysqli_fetch_array ($kategori)) {
echo '<h5>'.$kat['nama_kategori'] . '</h5>';
}


echo '
<h3>IDR. '.$row['harga_barang'] . '</h3>
</div>
</div>
</div> ';
echo'
<div class="detail">
<h4>Detail</h4>';
echo ' <p> '. $row['deskripsi']. '</p> </div>
</div>
  </div>';
  }
  if(isset($_SESSION['email'])){

  if($_SESSION['level']== 'pembeli') {
 echo'
  <div class="cart">
    <div class="header">
    <h4 style=" padding : 10px;"> add to cart now</h4>
    </div>
  
  <button type="submit"  class="btn btn-primary"  style="margin-top : 50px"> <a href="add_cart.php?id='.$id_barang.'"><i class="fas fa-cart-plus"></i> </a> </button>
</div>  ';
  } elseif ($_SESSION['level']== 'karyawan'){
    echo'
  <div class="cart">
    <div class="header">
    <h4 style=" padding : 10px;"> Tools</h4>
    </div>
  
  <button type="submit"  class="btn btn-primary" style="margin-top : 50px"> <a href="edit_item.php?id='.$id_barang.'"><i class="fas fa-edit"></i> </a> </button>
  <button type="submit"  class="btn btn-primary" style="margin-top : 50px"> <a href="delete_item.php?id='.$id_barang.'"><i class="fas fa-trash-alt"></i></a> </button>
</div>  ';  
  }
}else {
    echo'
    <div class="cart">
      <div class="header">
      <h4 style=" padding : 10px;"> add to cart now</h4>
      </div>
    
    <button   class="btn btn-primary" style="margin-top : 50px; width : 50px; height : 40px;"> <a href="add_cart.php?id='.$id_barang.'"><i class="fas fa-cart-plus"></i></a> </button>
  </div>  ';
}

?>

      
<!--         
<div class="container">
  <div class="isi">
  
  <div class="kotak"> 
    
    <div class="foto">
        <img src="data:image/jpeg;base64, base64_encode( $row['file'] )" alt="">
    </div>
   
   <div class="tag">
     <h2>MERCH TITLE</h2>
     <small> <a href="">category</a></small>
      <h3>$20</h3>
    </div>
    
       
     </div>
    
     

  <div class="detail">
  <h4>detail</h4>
    
    <p>
      
      
    </p>
 </div>
</div>
  </div>
<div class="cart">
    <div class="header">
    <h4 style=" padding : 10px;"> add to cart now</h4>
    </div>
  
  <button style="margin-top : 50px"> Add to Cart </button>
</div> -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
  </body>
</html>