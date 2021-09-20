<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <style>
        .container  {
          padding : 30px;
        }
        .status{
            margin-left : 30px;
            float : left;
            
            color : white;
            text-align : center;
            width : 300px;
            height : 200px;
        }
        .ongkir {
        float : left;
        
        text-align : center;
        background-color : #C4C4C4;
        width  : 520px;
        height : 200px;
        }

        .header_ongkir {
            height : 60px;
            justify-content : center;
        }

        .body_ongkir{
            text-align : left;
            background-color : whitesmoke;
            height : 100%;
            width : 100%;
            padding : 50px;
          
        }
        h5 {
            padding : 2px;
        }
        h4 {
            padding : 10px;
            color : #6A94FF;
        }
        .header_status {
            height : 60px;
            width : 300px;
            text-align: center;
            background-color : #C4C4C4;
            color : black;
            
        }
        .body_status {
            text-align : center;
            background-color : whitesmoke;
            height : 100%;
            width : 100%;
        }
        .status_bayar {
            text-align : center;
            width : 100%;
            margin-top : 20px;
            padding : 10px;
        }
      </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <?php 
  
        include('navbar.php');
        include('conn.php');
     

    $id_pembelian =  $_GET['id'];
    $total_total = 0;
        

    $result =  $conn->query("SELECT user.name , ongkir.kota , ongkir.harga , pembelian.id_pembelian ,status_bayar.status,
    pembelian.total_beli
    FROM pembelian

    JOIN user ON  user.id = pembelian.id_user 
    JOIN status_bayar ON  status_bayar.id_pembelian = pembelian.id_pembelian
    JOIN ongkir ON ongkir.id_ongkir = pembelian.id_ongkir 
    WHERE pembelian.id_pembelian = '$id_pembelian'");

    while ($row = $result->fetch_assoc()){ 

        $sql = $conn->query("SELECT barang.nama_barang ,barang.harga_barang , pembelian.id_pembelian 
        , pembelian_produk.jumlah
        
        FROM pembelian_produk
    
       JOIN barang on barang.id_barang = pembelian_produk.id_barang
    
        JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian
    
        WHERE pembelian.id_pembelian = ' $id_pembelian'");

        echo '<div class="container"> ';
        echo   ' <h4>  USER :'.$row['name'] .'</h4>';
        echo '<table class="table">
    
              <thead class="thead-dark">
                <tr>
                  <th scope="col"></th>
                  <th scope="col"> Product </th>
                  <th scope="col"> Price </th>
                  <th scope="col"> Quantity </th>
                  <th scope="col"> Total </th>
                </tr>
              </thead> ' ;
              
        echo '
              <tbody>
                '; 
                  while ($row2 = $sql->fetch_assoc()){
        echo   '
        <tr>
                  <th> </th>
                  <td>'. $row2['nama_barang'].'</td>';
        echo     '<td>IDR .'. $row2['harga_barang'].' </td>';
        echo   '   <td>
        '. $row2['jumlah'] .'
        
         </td> ';
         $jumlah = $row2['jumlah'];
         $harga =  $row2['harga_barang'];
                  
            
            $total = $jumlah * $harga;
       
        echo'
                  <td>IDR . '.$total.'</td>
                  
                </tr>';
                $total_total = $total_total + $total;
                  }
              
        echo'   
                <tr>
                  <td></td>
                  <td colspan="3"> Total</td>
                  <td>IDR . '.  $total_total .' </td>
                </tr>
            
              </tbody>
            </table>';

            echo '
            <div class="ongkir">
    <div class="header_ongkir"> 
        <h5 style="padding : 16px; "> SHIPPING </h5>  </div>  
    <div class="body_ongkir">
        <h5 style=" font-family : consolas;"> 
        Kota    : '. $row['kota'] .' <br>
        Harga   : IDR . '. $row['harga'] .' <br>
        --------------------------------------
        Total Harga <br>
        
        IDR . '. $row['total_beli'] .'

        </h5>
       
    

    </div>  
  

    </div>';

    if($row['status'] == 'ALREADY PAID'){
        echo '
      
    <div class="status" >
        <div class="header_status"><h5 style="padding : 16px;">Payment Information</h5></div>
        <div class="body_status">
      
            <div style="color : black; text-align : left; padding : 10px; font-family : consolas;">
            
            <h5>
            Payment Method :  Rekening
    </h5> 
            
            <div class="status_bayar" style="background-color : green;">
               <p>ALREADY PAID</p>
            </div>

            </div>
            
        </div>

    </div>
    
  </div>';
    
  
      
 
    } elseif($row['status'] == 'NOT PAID YET') {
        
    
       
    echo '
      
    <div class="status" >
        <div class="header_status"><h5 style="padding : 16px;">Payment Information</h5></div>
        <div class="body_status">
      
            <div style="color : black; text-align : left; padding : 10px; font-family : consolas;">
            
            <h5>
            Payment Method :  Rekening
    </h5> 
            
            <div class="status_bayar" style="background-color : red;">
               <p>NOT PAID YET</p>
            </div>

            </div>
            
        </div>

    </div>
    </div>';
    
    }
    }
    ?>

    

    
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     </body>
</html>