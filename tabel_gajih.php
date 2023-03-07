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
      $edit = mysqli_query($koneksi, "UPDATE tabel_gajih set
                                      kode_gajih = '$_POST[btnkode]',
                                      kode_karyawan = '$_POST[btnkode_karyawan]',
                                      absensi = '$_POST[btnabsensi]',
                                      lembur = '$_POST[btnlembur]',
                                      potongan = '$_POST[btnpotongan]',
                                      gajih_bersih = '$_POST[btngajih_bersih]'
                                      WHERE kode_gajih = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_gajih.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'tabel_gajih.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_gajih (kode_gajih, kode_karyawan, absensi, lembur, potongan, gajih_bersih)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnkode_karyawan]', '$_POST[btnabsensi]', '$_POST[btnlembur]', '$_POST[btnpotongan]', '$_POST[btngajih_bersih]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'tabel_gajih.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'tabel_gajih.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_gajih WHERE kode_gajih = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_gajih'];
        $vkode_karyawan = $data['kode_karyawan'];
        $vabsensi = $data['absensi'];
        $vlembur = $data['lembur'];
        $vpotongan = $data['potongan'];
        $vgajih_bersih = $data['gajih_bersih'];
    } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_gajih where kode_gajih = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'tabel_gajih.php';
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
  <h2 class="text-center">Tabel Resep Rumah Makan Mesir</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Resep Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="kode_gajih">Kode Gajih</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Kode Resep Disini" required>
        </div>
    
        <div class='form-group'>
          <label for="kode_karyawan">Kode Karyawan</label>
          <input type="text" name="btnkode_karyawan" value="<?=@$vkode_karyawan?>" class="form-control" placeholder="inputkan Nama Resep Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_karyawan">Tanggal Pengambilan</label>
          <input type="date" name="btnabsensi" value="<?=@$vabsensi?>" class="form-control" placeholder="inputkan Nama Resep Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_karyawan">Lembur</label>
          <input type="text" name="btnlembur" value="<?=@$vlembur?>" class="form-control" placeholder="inputkan Nama Resep Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_karyawan">Tambahan</label>
          <input type="number" name="btnpotongan" value="<?=@$vpotongan?>" class="form-control" placeholder="inputkan Nama Resep Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_karyawan">Gajih Bersih</label>
          <input type="number" name="btngajih_bersih" value="<?=@$vgajih_bersih?>" class="form-control" placeholder="inputkan Nama Resep Disini" required>
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
      Daftar Resep Rumah Makan Mesir
    </div>
    <div class="card-body">

      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>kode gajih</th>
          <th>kode karyawan</th>
          <th>Tanggal Pengambilan</th>
          <th>Tambahan</th>
          <th>potongan</th>
          <th>gajih bersih</th>
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_gajih");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
            <td><?=$no++;?></td>
          <td><?=$data['kode_gajih'];?></td>
          <td><?=$data['kode_karyawan']?></td>
          <td><?=$data['absensi']?></td>
          <td><?=$data['lembur']?></td>
          <td><?=$data['potongan']?></td>
          <td><?=$data['gajih_bersih']?></td>
          <td>
            <a href="tabel_gajih.php?hal=edit&id=<?=$data['kode_gajih']?>" class="btn btn-warning">Edit</a>
            <a href="tabel_gajih.php?hal=hapus&id=<?=$data['kode_gajih']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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