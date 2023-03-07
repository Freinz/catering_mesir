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
      $edit = mysqli_query($koneksi, "UPDATE tabel_supplier set
                                      kode_supplier = '$_POST[btnkode]',
                                      nama_supplier = '$_POST[btnsupplier]',
                                      alamat = '$_POST[btnalamat]', 
                                      pengirim = '$_POST[btnpengirim]', 
                                      tanggal = '$_POST[tanggal]'
                                      WHERE kode_supplier = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_supplier.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'tabel_supplier.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_supplier (kode_supplier, nama_supplier, pengirim, tanggal)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnsupplier]', '$_POST[btnpengirim]', '$_POST[tanggal]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'tabel_supplier.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'tabel_supplier.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_supplier WHERE kode_supplier = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_supplier'];
        $vnama = $data['nama_supplier'];
        $valamat = $data['alamat'];
        $vpengirim = $data['pengirim'];
        $vtanggal = $data['tanggal'];
      } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_supplier where kode_supplier = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'tabel_supplier.php';
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
  <h2 class="text-center">Tabel Produk Rumah Makan Mesir</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Produk Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="kode_supplier">Kode Supplier</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Kode Supplier Disini" required>
        </div>
        <div class='form-group'>
          <label for="nama_supplier">Nama Supplier</label>
          <input type="text" name="btnsupplier" value="<?=@$vnama?>" class="form-control" placeholder="inputkan Nama Supplier Disini" required>
        </div>
        <div class='form-group'>
          <label for="alamat">Alamat</label>
          <input type="text" name="btnalamat" value="<?=@$valamat?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="alamat">Pengirim</label>
          <input type="text" name="btnpengirim" value="<?=@$vpengirim?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="alamat">Tanggal Pembuatan</label>
          <input type="date" name="tanggal" value="<?=$vtanggal?>" class="form-control" placeholder="inputkan Tanggal Pembuatan Disini" required>
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
      Daftar Produk Rumah Makan Mesir
    </div>
    <div class="card-body">

      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>kode Supplier</th>
          <th>nama Supplier</th>
          <th>Alamat</th>
          <th>Pengirim</th>
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_supplier");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
          <td><?=$no++;?></td>
          <td><?=$data['kode_supplier'];?></td>
          <td><?=$data['nama_supplier']?></td>
          <td><?=$data['alamat']?></td>
          <td><?=$data['pengirim']?></td>
          <td><?=$data['tanggal']?></td>
          <td>
            <a href="tabel_supplier.php?hal=edit&id=<?=$data['kode_supplier']?>" class="btn btn-warning">Edit</a>
            <a href="tabel_supplier.php?hal=hapus&id=<?=$data['kode_supplier']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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