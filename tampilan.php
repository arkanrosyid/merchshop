<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <!-- content -->
    <section class="konten">

      <div class="container">
      <div class="row">
    

      <?php 
      include('conn.php');
         $hasil = mysqli_query($conn , ("SELECT * FROM barang "));
         if (mysqli_num_rows($hasil) > 0) {
          while ($row = mysqli_fetch_array ($hasil)) {

            echo '  
            <div class="col-sm-4" style =" margin-top: 20px; padding : 10px;">
           
            
       ';
            
            echo ' 
            
             <div class="thumbnail" style ="background :#EDEDED ;text-align: center; width : 300px; height: 431px; " ><div style="width: 300px; height: 300px;  background-color : #C4C4C4;"> 
            <img src="data:image/jpeg;base64,'.base64_encode( $row['file'] ).'" alt="" style="max-width: 300px; max-height: 300px;">
            </div>';
            echo '<div class="caption" style ="padding : 10px;">';
            echo ' <h3>'.$row['nama_barang'] .'</h3>'   ;    
            echo ' <h5>IDR. '.$row['harga_barang'].'</h5>';  

            if(isset($_SESSION['email'])){

            if($_SESSION['level']== 'pembeli') { 

            echo '<div class="button" style="width : 300px; text-align : center;">
            <a href="add_cart.php?id=' .$row['id_barang'] .'" class="btn btn-primary"><i class="fas fa-cart-plus"></i></a>
            <a href="detail.php?id=' .$row['id_barang'] .'" class="btn btn-primary"><i class="fas fa-info"></i></a>
            </div>
          
          ';

                  echo '   </div>
                            
                  </div>
              </div>
        ';   
        } elseif($_SESSION['level']== 'karyawan'){
          echo '<div class="button" style="width : 300px; text-align : center;">
          <a href="edit_item.php?id=' .$row['id_barang'] .'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
          <a href="detail.php?id=' .$row['id_barang'] .'" class="btn btn-primary"><i class="fas fa-info"></i></a>
          </div>

        ';

        echo '   </div>
                  
        </div>
        </div>
        ';   

}
      }else {
        echo '<div class="button" style="width : 300px; text-align : center;">
        <a href="add_cart.php?id=' .$row['id_barang'] .'" class="btn btn-primary"> <i class="fas fa-cart-plus"></i></a>
        <a href="detail.php?id=' .$row['id_barang'] .'" class="btn btn-primary"><i class="fas fa-info"></i></a>
        </div>

        ';

              echo '   </div>
                        
              </div>
          </div>
          ';   

        }
        }
              }
                  
            ?>

        <!-- <div class="row">

        <div class="col-sm-4" style =" margin-top: 20px;">
            <div class="thumbnail" style ="background :#EDEDED ;text-align: center; width : 300px; height: 431px; " >
            <div style="width: 300px; height: 300px;  background-color : #C4C4C4;"> 
                <img src="" alt="" style="max-width: 300px; max-height: 300px;">
            </div>
                <div class="caption" style ="padding : 10px;">
                    <h3>Jacket</h3>
                    <h5>$50</h5>
                    <div class="button" style="width : 300px; text-align : center;">
                        <a href="add_cart.php" class="btn btn-primary">add to cart</a>
                        <a href="detail.php" class="btn btn-primary">detail</a>
                      
                    </div>
                    
                </div>
            </div>
        </div> -->

        
        
        

        
        
       
  
      </div>
    </section>

</body>
</html>