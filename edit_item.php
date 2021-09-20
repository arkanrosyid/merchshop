<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
          .container{ 
            margin : 80px;
          }

            .foto{
                float : left;
                background-color : whitesmoke;
                height : 300px;
                width : 300px;
                text-align: center;
                margin : 20px;
            }
            .header{
                width : 1000px;
                background-color : #FF6767 ;
                padding : 20px;
                color : white;
            }
            .isi {
            height : 600px;
            width : 1000px;
            background-color : #EDEDED;
            float : left;
                        
            }   
            .teks {
                float : left ;
                margin : 20px;
            }
            .input-foto {
                text-align : center;
                padding : 20px;
            }
            .form-ctrl input{
                width : 300px;
            }
            .form-ctrl input[type= "submit"]{
            background-color: #FF6767 ;
            width : 300px;
            color : white;
            border : 2px solid #FF6767;

            }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  

      
    <?php 
      include('navbar.php');
        include('conn.php');
        $id_barang = $_GET['id']; 

        if($_SESSION['level']==""){
            header("location:index.php");
        }
        else if ($_SESSION['level']=="pembeli"){
            header("location:index.php");
        }
        else {
            $hasil = mysqli_query($conn , ("SELECT * FROM barang where id_barang = '$id_barang' "));
            $row = mysqli_fetch_array ($hasil); 
          
            ?> 
            
                
    <div class="container">
        <div class="isi">
            <div class="header">
                <h3>EDIT ITEM</h3>
            </div>
        
        <form method="POST" action="" enctype="multipart/form-data">
            
        <div class="update">  
       <?php echo '<div class="foto">
                <div style=" height: 300px;">
                <img src="data:image/jpeg;base64,'. base64_encode( $row['file'] ). '" alt="" style="max-width : 300px; ; max-height : 300px ;">
                </div>
            ';
            ?>
              <div class="input-foto">
        <button class="btn btn-primary"> <a href="edit_foto.php?id=<?php echo $id_barang; ?>" style ="color : white;"> Edit </a></button>
        </div>
        </div>

        <div class="teks">
            <div class="form-ctrl">
        <label for="">
                    Item Name
        </label>
        <br>
    <input type="text" name="nama" value="<?php echo "$row[nama_barang]";?>"><br>

    <br>
    </div>
    <div class="form-ctrl">
        <label for="">  Category </label>
        <br> 
    <select name ='id_kategori' id="" style="width : 300px;">
    <option >Choose </option>

            <?php

        $hasil3 = mysqli_query($conn , ("SELECT * FROM kategori_barang "));
        while ($kategori = $hasil3 -> fetch_assoc()){
            ?>
        <option  value= <?php echo $kategori['id_kategori'] ;?> > <?php
            echo   $kategori['nama_kategori']; }
            ?> </option>
            <?php 
             ?>
             </select>
        </div>
        <div class="form-ctrl">
        <label for="">Price IDR</label> <br>
        <input type="number" min="1000"  name="harga" value="<?php echo "$row[harga_barang]";?>"><br> 
        </div>
        <div class="form-ctrl">
            <label for="">
            Description <br>
            </label>
  
    <div class="deskripsi">
    <textarea name="textarea" rows="8" cols="40" >
    <?php  
    $textarea = $row['deskripsi'];
    echo $textarea;

  
    ?>
    </textarea>
    </div>
    </div>
    <div class="form-ctrl" >
    <input type=submit name=simpan value=Simpan>  </button>  
    </div>
   

    </div>
    
            <?php

        }
                
    ?>
    </div>     
          

     </form>
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

if(isset($_POST['simpan']))
{
    include('conn.php');

    $id_barang = $_GET['id']; 

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['textarea'];

            $conn -> query ("UPDATE `barang` SET `nama_barang`='$nama',`harga_barang`='$harga',`id_kategori`='$id_kategori',`deskripsi`='$deskripsi'  WHERE id_barang = '$id_barang' ");
        die($conn ->error);
        header("location:edit_item.php");

        
}
   
               

?>