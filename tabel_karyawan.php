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
      $edit = mysqli_query($koneksi, "UPDATE tabel_karyawan set
                                      kode_karyawan = '$_POST[btnkode]',
                                      Nama_Karyawan = '$_POST[btnnama]', 
                                      Alamat = '$_POST[btnAlamat]',
                                      Jenis_Kelamin = '$_POST[btnJenis_Kelamin]',
                                      No_telp = '$_POST[btnNo_telp]',
                                      tempat_lahir = '$_POST[btntempat_lahir]',
                                      tanggal = '$_POST[btntanggal]',
                                      jabatan = '$_POST[btnjabatan]'
                                      WHERE kode_karyawan = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_karyawan.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'tabel_karyawan.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_karyawan (kode_karyawan, Nama_Karyawan, Alamat, Jenis_Kelamin, No_telp, tempat_lahir, tanggal, jabatan)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnnama]', '$_POST[btnAlamat]', '$_POST[btnJenis_Kelamin]', '$_POST[btnNo_telp]', '$_POST[btntempat_lahir]', '$_POST[btntanggal]', '$_POST[btnjabatan]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'tabel_karyawan.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'tabel_karyawan.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_karyawan WHERE kode_karyawan = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_karyawan'];
        $vnama = $data['Nama_Karyawan'];
        $vAlamat = $data['Alamat'];
        $vJenis_Kelamin = $data['Jenis_Kelamin'];
        $vNo_telp = $data['No_telp'];
        $vtempat_lahir = $data['tempat_lahir'];
        $vtanggal = $data['tanggal'];
        $vjabatan = $data['jabatan'];
    } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_karyawan where kode_karyawan = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'tabel_karyawan.php';
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
  <h2 class="text-center">Tabel Karyawan Rumah Makan Mesir</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Karyawan Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="kode_karyawan">Kode Karyawan</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Nama Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="Nama_Karyawan">Nama Karyawan</label>
          <input type="text" name="btnnama" value="<?=@$vnama?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="Alamat">Alamat</label>
          <input type="text" name="btnAlamat" value="<?=@$vAlamat?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
            <label for="harga_produk">Jenis Kelamin</label>
            <input type="text" name="btnJenis_Kelamin" value="<?=@$vJenis_Kelamin?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">No Telp</label>
          <input type="number" name="btnNo_telp" value="<?=@$vNo_telp?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Tempat Lahir</label>
          <input type="texy" name="btntempat_lahir" value="<?=@$vtempat_lahir?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Tanggal</label>
          <input type="date" name="btntanggal" value="<?=@$vtanggal?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Jabatan</label>
          <input type="text" name="btnjabatan" value="<?=@$vjabatan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
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
      Daftar Karyawan Rumah Makan Mesir
    </div>
    <div class="card-body">

      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>kode_karyawan</th>
          <th>Nama_Karyawan</th>
          <th>Alamat</th>
          <th>Jenis_Kelamin</th>
          <th>No Telpon</th>
          <th>Tempat Lahir</th>
          <th>Tanggal</th>
          <th>Jabatan</th>
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_karyawan");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
            <td><?=$no++;?></td>
          <td><?=$data['kode_karyawan'];?></td>
          <td><?=$data['Nama_Karyawan']?></td>
          <td><?=$data['Alamat']?></td>
          <td><?=$data['Jenis_Kelamin']?></td>
          <td><?=$data['No_telp']?></td>
          <td><?=$data['tempat_lahir']?></td>
          <td><?=$data['tanggal']?></td>
          <td><?=$data['jabatan']?></td>
          <td>
            <a href="tabel_karyawan.php?hal=edit&id=<?=$data['kode_karyawan']?>" class="btn btn-warning">Edit</a>
            <a href="tabel_karyawan.php?hal=hapus&id=<?=$data['kode_karyawan']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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