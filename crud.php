<?php
  // koneksi database
  $server = "localhost"; // ip/domain
  $user = "root";
  $pass = "";
  $databases = "rumah_makan";

  $koneksi = mysqli_connect($server, $user, $pass, $databases) or die(mysqli_error($koneksi));

  // tombol simpan
  if(isset($_POST['btnsimpan'])) {
    
    // Pengujian apakah data akan diedit atau tersimpan yang baru
    if($_GET['hal'] == "edit") {
      // Data akan diedit
      $edit = mysqli_query($koneksi, "UPDATE tabel_produk set
                                      nama_produk = '$_POST[btnproduk]',
                                      harga_produk = '$_POST[btnharga]', 
                                      created_at = '$_POST[created_at]'
                                      WHERE kode_produk = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'crud.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'crud.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_produk (nama_produk, harga_produk, created_at)
                                      VALUES ('$_POST[btnproduk]', '$_POST[btnharga]', '$_POST[created_at]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'crud.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'crud.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE kode_produk = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vnama = $data['nama_produk'];
        $vharga = $data['harga_produk'];
        $vtanggal = $data['created_at'];
      } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_produk where kode_produk = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'crud.php';
            </script>";
       }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Membuat Website CRUD</title>
</head>
<body>

<!-- Awal Card From -->
<div class="container">
  <h2 class="text-center">Website CRUD + MYSQL + Bootstrap 4</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Produk Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="nama_produk">Nama Produk</label>
          <input type="text" name="btnproduk" value="<?=@$vnama?>" class="form-control" placeholder="inputkan Nama Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Harga Produk</label>
          <input type="number" name="btnharga" value="<?=@$vharga?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Tanggal Pembuatan</label>
          <input type="datetime-local" name="created_at" value="<?=$vtanggal?>" class="form-control" placeholder="inputkan Tanggal Pembuatan Disini" required>
        </div>

        <button type="submit" class="btn btn-success" name='btnsimpan'>Simpan</button>
        <button type="reset" class="btn btn-danger" name='btnreset'>Reset</button>
      </form>
    </div>
  </div>

<!-- Akhir Card Form -->
</div>
<script src="bootstrap.min.js"></script>

<!-- Awal Card Table -->
<div class="container">
  <div class="card mt-3">
    <div class="card-header bg-danger text-white">
      Daftar Produk Rumah Makan Mesir
    </div>
    <div class="card-body">

      <table class="table table-bordered table-striped">
        <tr>
          <th>kode_produk</th>
          <th>nama_produk</th>
          <th>harga_produk</th>
          <th>created_at</th>
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_produk");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
          <td><?=$data['kode_produk'];?></td>
          <td><?=$data['nama_produk']?></td>
          <td><?=$data['harga_produk']?></td>
          <td><?=$data['created_at']?></td>
          <td>
            <a href="crud.php?hal=edit&id=<?=$data['kode_produk']?>" class="btn btn-warning">Edit</a>
            <a href="crud.php?hal=hapus&id=<?=$data['kode_produk']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
          </td>
        </tr>

        <?php endwhile ; // penutup while?>
      </table>
     
    </div>
  </div>

<!-- Akhir Card Table -->
</div>
<script src="bootstrap.min.js"></script>  

</body>
</html>