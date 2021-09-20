<html>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
body {
    padding : 0;
    margin : 0;
    font-family : 'Roboto', sans-serif;
    font-weight : 500;
    }
h2 {
    font-size : 32px;
    font-weight : 700;
    }
a{
    color : #FF6767;
    text-decoration : none;
    }
a:hover {
    color : #FF6767;
    text-decoration : underline;
    }
.split-screen {
display : flex;
flex-direction : column;
position: relative;
}
.left{
height :414px;
position: absolute;
width :100%;
height : 900px;
}
.left {
  background : linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5)), url('');
  background-size : cover;
}
.left .copy {
  color : white;
  text-algin : center;
  -webkit-font-smoothing : antialiased;
  moz-osx-font-smoothing : grayscale;
}
.right{
background-color :  #6A94FF;
position: absolute;
right : 0px;
width :548px;

}
.right .copy{
  color : white;
}

.left, .right {
display :flex;
justify-content: center;
align-items: center;
height : 949px;
}
.teks{
text-align : center;
justify-content :center;
position: absolute;
top : 167px;
left : 159px;
right : 159px;	
}
.form-control {
margin-bottom:10px;
padding-bottom : 20px;
position: relative;
background-color: #6A94FF;
border-color: #6A94FF;
width : 300px;
height : 80px;
color : white;
}
.form-control label{
  display :inline-block;
  margin-bottom: 5px;
  color : white;
  
}
.form-control input {
  border : 2px solid #5F88F2;
  background-color: #5F88F2;
  border-radius :4px;
  width : 300px;
  height : 40px;
}

.form-control input[type= "submit"]{
	background-color: #FF6767 ;
    width : 300px;
    color : white;

}
.register{
    text-align : center;
}

small {
    text-align : center;
    color : white;
    font-size : 14px;
}

        </style>
</head>

  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- login form -->
    <?php
        session_start();


    if(empty($_SESSION['email'])){

               // alert

	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="kosong"){
			echo "<script>alert('Field can not be empety!'); </script>";
        }
        else if ($_GET['pesan']=="salah"){
        echo "<script>alert('Wrong E-mail or Password!'); </script>";
        }
	    }
    }
    else {
     
        header("location:index.php");
    }
       
	?>
            <div>
                <?php
            include('nav.html');
            ?>
            </div>

            <div class="right">
            <!-- register form -->
            <form action="register.php" method="POST" >
                <section class="copy">
                <div class="form-control">
                    <label>Name</label> <br>
                    <input type="text" id="username" name="username" placeholder="surename" >
                </div>
                <div class="form-control">
                    <label>E-mail</label> <br>
                    <input type="email" id="email" name="email" placeholder="example@mai.com" >
                </div>
                
                <div class="form-control">
                    <label>Password</label> <br>
                    <input type="password" id="password" name="password" placeholder="min 6 characters length  " >
                </div>
                <div class="form-control">
                    <label>Password</label> <br>
                    <input type="password" id="password2" name="password2" placeholder="Confirm Password"  >
                </div>
                            
                            
                            <div class="form-control">
                                <input class= "button" type="submit" name="submit" id="submit" value="submit" >
                                <small> <p> By continuing, you agree to accept our <br>
              <a href="#" class="href"> Privacy Policy </a>  & <a href="#" class="href">Terms of Service</a>.
              </p></small>
                            </div>
                </section>
            </form>
            </div>
        </div>
   



</body>


</html>

<?php 
    
    if (isset($_POST['submit'])){
      $name       = $_POST['username'];
      $email      = $_POST['email'];
      $password   = md5($_POST['password']);
      $password2  = md5($_POST['password2']);
      $level = "2";

      $errorEmpety = false ;
      $errorEmail = false ;

          if (empty($name) || empty($email) || empty($password) || empty($password2))
          {
            echo "<script>alert('Field can not be empety!'); </script>";
            $errorEmpety = true ;
          }

          else if (!filter_var($email,  FILTER_VALIDATE_EMAIL)){
            echo "<script>alert('Write a valid e-mail!'); </script>";
            $errorEmpety = true ;
            $errorEmail = true ;
          
          }

          else if ($password2 != $password) {
            echo "<script>alert('Password did not match'); </script>";
            $errorEmpety = true ;
          }

          else {
            
                include 'conn.php';
                $cekEmail = mysqli_query($conn, "select * from `user`where email='$email'");
                $cek = mysqli_num_rows($cekEmail);

              // cek apakah email di temukan pada database
                if($cek > 0) { 
                  echo "<script>alert('E-mail already registered!'); </script>";
                }
                
                  else {
                        $conn->query("INSERT INTO `user`(`name`,`email`, `password`  ,`level`) VALUES ('$name', '$email ', '$password','$level')") or 
                                            die($conn ->error);

                        echo "<script>alert('Thanks for registering'); </script>";
                        $errorEmpety = false ;
                        
                        

                  }

          }

 
    }

?>
