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
      $edit = mysqli_query($koneksi, "UPDATE tabel_menu set
                                      kode_menu = '$_POST[btnkode]',
                                      nama_makanan = '$_POST[btnnama]', 
                                      kategori = '$_POST[btnkategori]',
                                      harga_satuan = '$_POST[btnharga_satuan]',
                                      ketersediaan_menu = '$_POST[btnketersediaan_menu]',
                                      waktu_persiapan = '$_POST[btnwaktu_persiapan]'
                                      WHERE kode_menu = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_menu.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'tabel_menu.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_menu (kode_menu, nama_makanan, kategori, harga_satuan, ketersediaan_menu, waktu_persiapan)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnnama]', '$_POST[btnkategori]', '$_POST[btnharga_satuan]', '$_POST[btnketersediaan_menu]', '$_POST[btnwaktu_persiapan]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'tabel_menu.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'tabel_menu.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_menu WHERE kode_menu = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_menu'];
        $vnama = $data['nama_makanan'];
        $vkategori = $data['kategori'];
        $vharga_satuan = $data['harga_satuan'];
        $vketersediaan_menu = $data['ketersediaan_menu'];
        $vwaktu_persiapan = $data['waktu_persiapan'];

    } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_menu where kode_menu = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'tabel_menu.php';
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
          <label for="kode_menu">Kode Menu</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Nama Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nama_makanan">Nama Makanan</label>
          <input type="text" name="btnnama" value="<?=@$vnama?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="kategori">kategori</label>
          <input type="text" name="btnkategori" value="<?=@$vkategori?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
            <label for="harga_produk">Harga Satuan</label>
            <input type="text" name="btnharga_satuan" value="<?=@$vharga_satuan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Ketersediaan Menu</label>
          <input type="text" name="btnketersediaan_menu" value="<?=@$vketersediaan_menu?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="harga_produk">Waktu Persiapan</label>
          <input type="text" name="btnwaktu_persiapan" value="<?=@$vwaktu_persiapan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
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
          <th>kode_menu</th>
          <th>nama makanan</th>
          <th>kategori</th>
          <th>harga_satuan</th>
          <th>Ketersediaan Menu</th>
          <th>Waktu Persiapan</th>
         
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_menu");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
            <td><?=$no++;?></td>
          <td><?=$data['kode_menu'];?></td>
          <td><?=$data['nama_makanan']?></td>
          <td><?=$data['kategori']?></td>
          <td><?=$data['harga_satuan']?></td>
          <td><?=$data['ketersediaan_menu']?></td>
          <td><?=$data['waktu_persiapan']?></td>

          <td>
            <a href="tabel_menu.php?hal=edit&id=<?=$data['kode_menu']?>" class="btn btn-warning">Edit</a>
            <a href="tabel_menu.php?hal=hapus&id=<?=$data['kode_menu']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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