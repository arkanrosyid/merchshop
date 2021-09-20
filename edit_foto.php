<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .update {
                background-color : whitesmoke;
                margin : 20px;
                text-align : center;
                padding : 20px;
            }
        </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <?php    
      include('navbar.php');
      include('conn.php');
      $id_barang = $_GET['id']; 

      $hasil = mysqli_query($conn , ("SELECT * FROM barang where id_barang = '$id_barang' "));
     $row = mysqli_fetch_array ($hasil); ?>
      
  <div class="container">

        <form method="POST" action="" enctype="multipart/form-data">
            
            <div class="update">  
           <?php echo '<div class="foto">
                    <div style=" height: 300px;">
                    <img src="data:image/jpeg;base64,'. base64_encode( $row['file'] ). '" alt="" style="max-width : 300px; ; max-height : 300px ;">
                    </div>
                ';
                ?>
                  <div class="input-foto">
            <input type="file" name="image" id="image">
            </div>
            <div class="form-ctrl" >
                <input type=submit name=simpan value=Simpan>  </button>  
                </div>
   
            </div>
        </form>
  
         <div>
        <a href="edit_item.php?id=<?php echo $id_barang ;?>"><i class="fas fa-arrow-circle-left"></i></a>
    </div>


    </div>
   






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php

if(isset($_POST['simpan'])){

    $foto  = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];

    
    $conn -> query ("UPDATE `barang` SET `file`='$foto',`file_name`='$file_name',`file_type`='$file_type',`file_size`='$file_size'  WHERE id_barang = '$id_barang' ");
    die($conn ->error);
echo "<script>alert('Succes Image'); </script>";


}


?>