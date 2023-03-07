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
      $edit = mysqli_query($koneksi, "UPDATE tabel_bahan set
                                      kode_bahan = '$_POST[btnkode]',
                                      nama_bahan = '$_POST[btnnama]', 
                                      banyak = '$_POST[btnbanyak]',
                                      kategori = '$_POST[btnkategori]',
                                      jenis_bahan = '$_POST[btnjenis_bahan]',
                                      created_at = '$_POST[created_at]',
                                      price = '$_POST[btnprice]'
                                      WHERE kode_bahan = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_bahan.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'tabel_bahan.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_bahan (kode_bahan, nama_bahan, banyak, kategori, jenis_bahan, created_at, price)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnnama]', '$_POST[btnbanyak]', '$_POST[btnkategori]','$_POST[btnjenis_bahan]', '$_POST[created_at]', '$_POST[btnprice]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'tabel_bahan.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'tabel_bahan.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_bahan WHERE kode_bahan = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_bahan'];
        $vnama = $data['nama_bahan'];
        $vbanyak = $data['banyak'];
        $vkategori = $data['kategori'];
        $vjenis_bahan = $data['jenis_bahan'];
        $vtanggal = $data['created_at'];
        $vprice = $data['price'];
    } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_bahan where kode_bahan = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'tabel_bahan.php';
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
  <h2 class="text-center">Tabel Bahan Rumah Makan Mesir</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Bahan Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="kode_bahan">Kode Bahan</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Nama Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nama_bahan">Nama Bahan</label>
          <input type="text" name="btnnama" value="<?=@$vnama?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="banyak">Banyak</label>
          <input type="text" name="btnbanyak" value="<?=@$vbanyak?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
            <label for="harga_produk">Kategori</label>
            <input type="text" name="btnkategori" value="<?=@$vkategori?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
            <label for="harga_produk">Jenis Bahan</label>
            <input type="text" name="btnjenis_bahan" value="<?=@$vjenis_bahan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Tanggal Pembuatan</label>
          <input type="date" name="created_at" value="<?=$vtanggal?>" class="form-control" placeholder="inputkan Tanggal Pembuatan Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Price</label>
          <input type="number" name="btnprice" value="<?=@$vprice?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>

        <button type="submit" class="btn btn-success" name='btnsimpan'>Simpan</button>
        <button type="reset" class="btn btn-danger" name='btnreset'>Reset</button>
        <a href="index.php" class="btn btn-primary">Landing Page</a>
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
      Daftar Bahan Rumah Makan Mesir
    </div>
    <div class="card-body">

      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>kode_bahan</th>
          <th>nama_bahan</th>
          <th>banyak</th>
          <th>kategori</th>
          <th>Jenis Bahan</th>
          <th>created_at</th>
          <th>price</th>
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_bahan");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
            <td><?=$no++;?></td>
          <td><?=$data['kode_bahan'];?></td>
          <td><?=$data['nama_bahan']?></td>
          <td><?=$data['banyak']?></td>
          <td><?=$data['kategori']?></td>
          <td><?=$data['jenis_bahan']?></td>
          <td><?=$data['created_at']?></td>
          <td><?=$data['price']?></td>
          <td>
            <a href="tabel_bahan.php?hal=edit&id=<?=$data['kode_bahan']?>" class="btn btn-warning">Edit</a>
            <a href="tabel_bahan.php?hal=hapus&id=<?=$data['kode_bahan']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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