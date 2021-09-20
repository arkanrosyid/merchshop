
<?php 

    // proses login
    
        if(empty($_POST["email"]) && empty($_POST["password"]))  
        { 
           
            header("location:login.php?pesan=kosong");
           
        }
        else {

             // konek database
             include 'conn.php';

             //post define
             $email = $_POST['email'];
             $password = md5($_POST['password']);
             

             $login = mysqli_query($conn, "select * from user where  email  ='$email' and password='$password'   ");
             $cek = mysqli_num_rows($login);

            // cek apakah email dan password di temukan pada database
            if($cek > 0){
                session_start();
               
                $level =$login -> fetch_assoc();
                $data = $level['level'];

                if ($data == "1") {
                      // buat session email
                $_SESSION['email'] = $email;
                $_SESSION['level'] = 'karyawan';
                
            //  alihkan ke halaman index
            header("location:index.php");
            // echo "<pre>";
            // echo print_r ($_SESSION['email']);
            // echo print_r ($_SESSION['level']);
            // echo "</pre>";
         
            

                } elseif ($data == "2"){

               
                // buat session email
                $_SESSION['email'] = $email;
                $_SESSION['level'] = 'pembeli';
                    
                // echo "<pre>";
                // echo print_r ($_SESSION['email']);
                // echo print_r ($_SESSION['level']);
                // echo "</pre>";
             
                //  alihkan ke halaman index
                header("location:index.php");
                }

            }else{
                // error
              

                header("location:login.php?pesan=salah");
                
        

             }

        }
 
    
?>