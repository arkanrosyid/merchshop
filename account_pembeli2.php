<?php 

    include('conn.php');
       session_start();

       $email = $_SESSION['email'];

          if(isset($_POST['submit'])){
            if (empty($_POST['password'])){
                header("location:account_pembeli.php?pesan=kosong");
            }
            else {
              $password = md5($_POST['password']);
              $login = mysqli_query($conn,("SELECT * FROM user WHERE email ='$email' and password ='$password'"));
              $cek = mysqli_num_rows($login);
              if($cek > 0) {
                $nama = $_POST['name'];
                $nohp = $_POST['phone'];
                $alamat = $_POST['alamat'];
                
                $conn -> query ("UPDATE `user` SET `name`='$nama',`no_hp`='$nohp' ,`alamat`='$alamat' WHERE email = '$email' ");
                
               
               
                
                header("location:account_pembeli.php?pesan=sukses");
                echo "<script>alert('Succes'); </script>";


              }else {
                echo "<script>alert('Wrong Password'); </script>";
                header("location:account_pembeli.php?pesan=salah");

              }
           }

          }

?>