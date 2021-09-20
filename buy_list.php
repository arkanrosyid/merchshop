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
        <th scope="col"> # </th>
        <th scope="col"> Date </th>
        <th scope="col"> Payment Information </th>
      </thead>
  
      <tbody>
        <?php
        $no = 1;
        
      $hasil2 = mysqli_query($conn , ("SELECT * FROM `user`  where email = '$email' "));
      if (mysqli_num_rows($hasil2) > 0) {
        $data =$hasil2 -> fetch_assoc();
        $id_user = $data['id'];
      }
         
         $hasil = mysqli_query($conn , ("SELECT * FROM pembelian where id_user = '$id_user' "));
         if (mysqli_num_rows($hasil) > 0) {
          while ($row = mysqli_fetch_array ($hasil)) { 
            echo '    <tr>
          
            <td> '. $no .'</td>
            <td> '. $row['tanggal_beli'] .'</td>
            <td>
              <div class="action">  
               <button  class="btn btn-primary "  ><a href="nota.php?id='.$row['id_pembelian'].'"> <i class="fas fa-info" style="color : white;"></i> </a>
             </div> 
             </td>
            
          </tr>
  ' ;
    $no++;
      
          }
        }
       ?>
    

    
      </tbody>
    </table>
      
    

  </div>





      </body>
</html>