<!doctype html>
<html lang="en">
  <head>
    <title>Add Item</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        body {
    padding : 0;
    margin : 0;
    font-family : 'Roboto', sans-serif;
    font-weight : 500;
    }
        .container{
            background-color : #EDEDED;
            margin : 80px;
            width : 100%;
            background-color : #EDEDED;
       
 ;

            ;

        }
     
        .form-full{
            float : right;
            display : inline-block
            text-align : left;
            width : 400px;
            padding : 20px;
            margin-right:350px;
          

         

        }
        .form-full .form input{
            width : 100%;
            height : 40px;
        }


        .form- input[type= "submit"]{
	background-color: #FF6767 ;
    width : 300px;
    color : white;

}
        
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>
  <body>
        <?php 
          include 'navbar.php';
          
        
            if($_SESSION['level']==""){
                header("location:index.php");
            }
            else if ($_SESSION['level']=="pembeli"){
                header("location:index.php");
            }
            else {

                include 'conn.php';
   
        ?>

                <div class="container">

              
                <form action="" method="POST"  enctype="multipart/form-data" >
            <div class="form-full">
                <div class="header"> 
                    <h3>Input Item</h3>
                </div>

                    <div class="form">
                    <label>Name</label> <br>
                    <input type="text" id="name" name="name"  >
                    </div>

                    <div class="form">
                    <label>Category</label> <br>
                    <select name ='id_kategori' id="id_kategori">
                    
                    <option> Choose Category </option>   
                    <?php 
                    $hasil = mysqli_query($conn , ("SELECT * FROM kategori_barang "));
                    while ($kategori = $hasil -> fetch_assoc()){
                        ?>
                    <option  value= <?php echo $kategori['id_kategori'] ;?> > <?php
                        echo   $kategori['nama_kategori'];
                        ?></option>
       
                        <?php
                    }
                
                ?>
                </select> 
                    </div >

                    <div class="form">
                   <label > Price </label> <br>
                          Rp. <input type="number" min="1000"  name="harga" id="harga"><br>
                    </div>


                    <div class="form">
                    <label> Description </label> <br>
                    <textarea name="deskripsi" rows="4" cols="50" name="deskripsi"></textarea>
                    </div>

                    <div class="form">
                        <label> Upload Photo </label>
                    
                        <input type="file" name="image" id="image" ><br>

                    </div>
              
                     <div class="form">
                         <label>Confirm your Password</label>
                         <br>
                         <input type="password" name="password" id ="password">  <br>
                    </div>
                            
                     <div class="form">
                     <input class= "button" type="submit" name="submit" id="submit" value="submit" >
                     </div>
                     </div>
                    
                     </form>

                </div>
                    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    


    <?php }
     ?>
    </body>
</html>

<?php 

        include 'conn.php';
    if(isset($_POST['submit'])) {

      
       
        if(empty($_POST['password']) || empty($_POST['id_kategori']) || empty($_POST['name']) || empty($_POST['harga'])   ){
            echo "<script>alert('Field can not be empety'); </script>";
         }else {
            
            $email = $_SESSION['email'];
            $password1 = mysqli_real_escape_string($conn, $_POST["password"]);  
            $password2 = md5($password1);
              

            $login = mysqli_query($conn, "select * from user where   password='$password2' and email='$email' ");

            $cek = mysqli_num_rows($login);

            if($cek > 0) {
                $nama = $_POST['name'];
                $harga = $_POST['harga'];
                $id_kategori = $_POST['id_kategori'];
                $deskripsi = $_POST['deskripsi'];
                $foto   = $_FILES['image']['tmp_name'];
                $image = addslashes(file_get_contents($foto));
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_type = $_FILES['image']['type'];

                
                $conn -> query ("INSERT INTO `barang`( `nama_barang`, `harga_barang`, `id_kategori`, `deskripsi`, `file` , `file_name`, `file_type`, `file_size`) 
                VALUES ( '$nama' , '$harga' , '$id_kategori','$deskripsi', '$image' ,'$file_name' , '$file_type', '$file_size' )");
                die($conn ->error);
              

                echo "SUCCES UPLOADING";
                
                           

            }

            else{
                echo "<script>alert('Worng Password'); </script>";
            }
                                        
                

            
        }
     }
?>