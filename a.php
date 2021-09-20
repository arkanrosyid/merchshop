<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>


    <?php
    $id_pembelian = 4;
    include('conn.php');


    $result =  $conn->query("SELECT user.name , ongkir.kota , ongkir.harga , pembelian.id_pembelian ,status_bayar.status,
    pembelian.total_beli
    FROM pembelian

    JOIN user ON  user.id = pembelian.id_user 
    JOIN status_bayar ON  status_bayar.id_pembelian = pembelian.id_pembelian
    JOIN ongkir ON ongkir.id_ongkir = pembelian.id_ongkir 
    WHERE pembelian.id_pembelian = '$id_pembelian'");

    while ($row = $result->fetch_assoc()){
        echo $row['name'];
       

        $sql = $conn->query("SELECT barang.nama_barang ,barang.harga_barang , pembelian.id_pembelian 
        , pembelian_produk.jumlah

    FROM pembelian_produk 

   JOIN barang on barang.id_barang = pembelian_produk.id_barang

    JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian

    WHERE pembelian.id_pembelian = ' $id_pembelian'");

    while ($row2 = $sql->fetch_assoc()){

        echo $row2['nama_barang'];
        echo $row2['harga_barang'];


    }


        echo $row['kota'];
        echo $row['harga'];
        echo $row['total_beli'];
        echo $row['status'];
    }
    
    ?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>