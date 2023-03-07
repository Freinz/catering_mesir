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
      $edit = mysqli_query($koneksi, "UPDATE tabel_customer set
                                      kode_customer = '$_POST[btnkode_customer]',
                                      first_name = '$_POST[btnfirst]', 
                                      last_name = '$_POST[btnlast]',
                                      no_telp = '$_POST[btntelp]',
                                      email = '$_POST[btnemail]'
                                      WHERE kode_customer = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'tabel_customer.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'tabel_customer.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO tabel_customer (kode_customer, first_name, last_name, no_telp, email)
                                      VALUES ('$_POST[btnkode_customer]', '$_POST[btnfirst]', '$_POST[btnlast]', '$_POST[btntelp]', '$_POST[btnemail]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'tabel_customer.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'tabel_customer.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_customer WHERE kode_customer = '$_GET[id]' " );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_customer'];
        $vfirst = $data['first_name'];
        $vlast = $data['last_name'];
        $vtelp = $data['no_telp'];
        $vemail = $data['email'];
      } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM tabel_customer where kode_customer = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'tabel_customer.php';
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
  <h2 class="text-center">Tabel Customer Rumah Makan Mesir</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Customer Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="kode_customer">Kode Customer</label>
          <input type="text" name="btnkode_customer" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Kode Customer Disini" required>
        </div>
        <div class='form-group'>
          <label for="first_name">First Name</label>
          <input type="text" name="btnfirst" value="<?=@$vfirst?>" class="form-control" placeholder="inputkan Harga Customer Disini" required>
        </div>
        <div class='form-group'>
          <label for="first_name">Last Name</label>
          <input type="text" name="btnlast" value="<?=@$vlast?>" class="form-control" placeholder="inputkan Tanggal Pembuatan Disini" required>
        </div>
        <div class='form-group'>
          <label for="first_name">No Telp</label>
          <input type="number" name="btntelp" value="<?=@$vtelp?>" class="form-control" placeholder="inputkan Tanggal Pembuatan Disini" required>
        </div>
        <div class='form-group'>
          <label for="first_name">Email</label>
          <input type="text" name="btnemail" value="<?=@$vemail?>" class="form-control" placeholder="inputkan Tanggal Pembuatan Disini" required>
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
      Daftar Customer Rumah Makan Mesir
    </div>
    <div class="card-body">

      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>Kode Customer</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>No Telp</th>
          <th>Email</th>
        </tr>

        <?php
          $no = 1;
          $tampil = mysqli_query($koneksi, "SELECT * from tabel_customer");
          while($data = mysqli_fetch_array($tampil)) :

        ?>

        <tr>
          <td><?=$no++;?></td>
          <td><?=$data['kode_customer'];?></td>
          <td><?=$data['first_name']?></td>
          <td><?=$data['last_name']?></td>
          <td><?=$data['no_telp']?></td>
          <td><?=$data['email']?></td>
          <td>
            <a href="tabel_customer.php?hal=edit&id=<?=$data['kode_customer']?>" class="btn btn-warning">Edit</a>
            <a href="tabel_customer.php?hal=hapus&id=<?=$data['kode_customer']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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