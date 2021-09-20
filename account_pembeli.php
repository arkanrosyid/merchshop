<!doctype html>
<html lang="en">
  <head>
    <title>Account</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
     .container{
       margin : 50px;
       width : 1000px;
       height : 800px;
     }
     .left{

       margin : 20px;
      text-align : center;
      background-color:whitesmoke;
       height : 400px;
       width : 300px;
       float : left;

     }
     .foto{
       
       background-color: #C4C4C4;
       height : 300px;
       width : 300px;
     }
     .right{
      margin : 20px;
       margin-left: 40px;
       float : left;
       width : 700px ;
       height : 100%;
       text-align : center;
       background-color:whitesmoke;
     }
     .head{
       
      margin-top : 30px;
     }
     .body {
       text-align : left;
     }
     .btn-edit {
       margin : 30px;
     }

     
.form-acc label{
  display :inline-block;
  margin-bottom: 5px;
  
}
.form-acc input {

border-radius :4px;
width : 300px;
height : 40px;
}

.bawah {
  width : 300px;
  margin : 30px;
  margin-left : 200px;
}
.btn-submit {
  margin : 20px;
  margin-left : 130px;
}

     
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <?php 
    
        include('conn.php');
        include('navbar.php');

        if(isset($_GET['pesan'])){
          if($_GET['pesan']=="kosong"){
            echo "<script>alert('Passwrod field can not be empety!'); </script>";
              }
              else if ($_GET['pesan']=="salah"){
              echo "<script>alert('Wrong Password!'); </script>";
              } else if ($_GET['pesan']=="sukses"){
                echo "<script>alert('Succes'); </script>";
              }
            }
         
            $email = $_SESSION['email'];
            $result = mysqli_query($conn,("SELECT * FROM user WHERE email ='$email'"));

            while ($row = mysqli_fetch_array ($result)) {
             
    
    ?>

    <div class="container">

      <div class="left"> 
      <div class="foto">
            <?php
     echo' <img src="data:image/jpeg;base64,'.base64_encode( $row['file'] ).'" alt="" style="max-width: 300px; max-height: 300px;">';
          ?>
      </div>
      <div class="btn-edit"> <a href="foto_acc.php">
      <button class="btn btn-primary"> <i class="fas fa-edit" style ="color : white;"></i> </button>    
    </a>
      
      </div>
      </div>

      <div class="right">
        <div class="head"> <h4> USER INFORMATION </h4></div>
        <div class="body"> 
       
        <div class="bawah">
          <form action="account_pembeli2.php" method="POST">
            
          <div class="isi">
         
          <?php 
          
           

              echo ' <div class="form-acc"> 
              <label for=""> NAME</label> <br>
              
              <input type="text" value ="'. $row['name'] .'" name="name"> 
              </div>
            ';

            echo '
            <div class="form-acc"> 
            <label for=""> Phone Number</label> <br>
            <input type="tel" value ="'. $row['no_hp'] .'" name="phone" placeholder="081-111-111-111" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{3}" > 
            <small>Format: 081-111-111-111</small><br><br>
            </div>
          ';
          echo '
          <div class="form-acc"> 
          <label for=""> Address</label> <br>
          <textarea name="alamat" rows="4" cols="40" value ="'. $row['alamat'].'">  
          </textarea>

          </div>
        ';

             }
          
          ?>
          
            <div class="form-acc"> 
            <label for=""> Confirm Password</label> <br>
            <input type="password" value ="" name="password"> 

            </div >
            

            <div class="btn-submit" >
              <button class="btn btn-primary" type="submit" name="submit"> <i class="fas fa-save" style ="color : white; size : 9px;"></i></button>
            </div>

          </div>
        </div>
        </form>
        </div>
      </div>
    
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    </body>
</html>

