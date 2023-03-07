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
      $edit = mysqli_query($koneksi, "UPDATE transaksi_customer set
                                      kode_transcustomer = '$_POST[btnkode]',
                                      kode_customer = '$_POST[btnkode_customer]',
                                      kode_menu = '$_POST[btnkode_menu]',
                                      nomor_meja = '$_POST[btnnomor_meja]',
                                      kode_karyawan = '$_POST[btnkode_karyawan]',
                                      banyak = '$_POST[btnbanyak]',
                                      total_harga = '$_POST[btntotal_harga]',
                                      metode_pembayaran = '$_POST[btnmetode_pembayaran]',
                                      tanggal_transaksi = '$_POST[btntanggal_transaksi]'
                                      WHERE kode_transcustomer = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'transaksi_customer.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'transaksi_customer.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO transaksi_customer (kode_transcustomer, kode_customer, kode_menu,  nomor_meja, kode_karyawan, banyak, total_harga, metode_pembayaran, tanggal_transaksi)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnkode_customer]','$_POST[btnkode_menu]', '$_POST[btnnomor_meja]', '$_POST[btnkode_karyawan]', '$_POST[btnbanyak]', '$_POST[btntotal_harga]','$_POST[btnmetode_pembayaran]', '$_POST[btntanggal_transaksi]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'transaksi_customer.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'transaksi_customer.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM transaksi_customer;" );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_transcustomer'];
        $vkode_customer = $data['kode_customer'];
        $vkode_menu = $data['kode_menu'];
        $vnomor_meja = $data['nomor_meja'];
        $vkaryawan = $data['kode_karyawan'];
        $vbanyak = $data['banyak'];
        $vtotal_harga = $data['total_harga'];
        $vmetode_pembayaran = $data['metode_pembayaran'];
        $vtanggal_transaksi = $data['tanggal_transaksi'];
    } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM transaksi_customer where kode_transcustomer = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'transaksi_customer.php';
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
  <h2 class="text-center">Tabel Penjualan Rumah Makan Mesir</h2>

  <div class="card mt-3">
    <div class="card-header bg-primary text-white">
      Form Input Tabel Penjualan Rumah Makan Mesir
    </div>
    <div class="card-body">
      <form action="" method="post">
        
        <div class='form-group'>
          <label for="kode_transcustomer">Kode Transaksi Custoer</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Nama Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_menu">Kode Customer</label>
          <input type="text" name="btnkode_customer" value="<?=@$vkode_customer?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_menu">Kode Menu</label>
          <input type="text" name="btnkode_menu" value="<?=@$vkode_menu?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nomor_meja">Nomor Meja</label>
          <input type="number" name="btnnomor_meja" value="<?=@$vnomor_meja?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nomor_meja">Kode Karyawan</label>
          <input type="text" name="btnkode_karyawan" value="<?=@$vkaryawan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nomor_meja">Banyak</label>
          <input type="number" name="btnbanyak" value="<?=@$vbanyak?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nomor_meja">Total Harga</label>
          <input type="number" name="btntotal_harga" value="<?=@$vtotal_harga?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nomor_meja">Metode Pembayaran</label>
          <input type="text" name="btnmetode_pembayaran" value="<?=@$vmetode_pembayaran?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="nomor_meja">Tanggal Transaksi</label>
          <input type="date" name="btntanggal_transaksi" value="<?=@$vtanggal_transaksi?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
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
      Daftar Penjualan Rumah Makan Mesir
    </div>
    <div class="card-body">

    <form method="get" action="">
        <table>
          <tr>
            <td>Tanggal Mulai</td>
            <td><input type="date" name='daritotal_harga' class="ml-2 mr-2" required></td>
            <td>Tanggal Selesai</td>
            <td><input type="date" name='sampaitotal_harga' class="ml-2 mr-3" required></td>
            <td><input type="submit" class='btn btn-info' name='filter' value='Filter'></td>
          </tr>
        </table>
      </form>
      <br>
      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>Kode Transaksi Customer</th>
          
          <th>Kode Customer</th>
          <th>First Name</th>
          <th>Kode Menu</th>
          <th>Nama Makanan</th>
          <th>Harga Satuan</th>
          <th>Ketersediaan Menu</th>
         

          <th>No Meja</th>
          <th>Kode Karyawan</th>
          <th>Nama Karyawan</th>

          <th>Banyak</th>
          <th>Total Harga</th>
          <th>Metode Pembayaran</th>
          <th>Tanggal Transaksi</th>
        </tr>
        <?php
          $no = 1;
          $tampil= mysqli_query($koneksi, "SELECT *
          FROM transaksi_customer 
          JOIN tabel_customer ON transaksi_customer.kode_customer = tabel_customer.kode_customer
          JOIN tabel_menu on transaksi_customer.kode_menu = tabel_menu.kode_menu
          JOIN tabel_karyawan on transaksi_customer.kode_karyawan = tabel_karyawan.kode_karyawan
          ;");
          if(isset($_GET['filter'])) {
            $daritotal_harga = mysqli_real_escape_string($koneksi, $_GET['daritotal_harga']);
            $sampaitotal_harga = mysqli_real_escape_string($koneksi, $_GET['sampaitotal_harga']);
            $tampil = mysqli_query($koneksi, "SELECT * FROM transaksi_customer  
         WHERE tanggal_transaksi BETWEEN '$daritotal_harga' AND '$sampaitotal_harga' ");
            if(mysqli_num_rows($tampil)==0){
            echo '<tr><td align="center" colspan="5">Tidak ada data</td></tr>';
            }else{
            while($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['kode_transcustomer']; ?></td>

                <td><?= $data['kode_customer']; ?></td>
                <td><?= $data['first_name']; ?></td>
                <td><?= $data['kode_menu']; ?></td>
                <td><?=$data['nama_makanan']?></td> 
                <td><?=$data['harga_satuan']?></td>
                <td><?= $data['ketersediaan_menu']; ?></td>

                <td><?= $data['nomor_meja']; ?></td>

                <td><?= $data['kode_karyawan']; ?></td>
                <td><?= $data['Nama_Karyawan']; ?></td>

                <td><?= $data['banyak']; ?></td>
                <td><?= $data['total_harga']; ?></td>
                <td><?= $data['metode_pembayaran']; ?></td>
                <td><?= $data['tanggal_transaksi']; ?></td>
            

            <td>
            <a href="transaksi_customer.php?hal=edit&id=<?=$data['kode_transcustomer']?>" class="btn btn-warning">Edit</a>
            <a href="transaksi_customer.php?hal=hapus&id=<?=$data['kode_transcustomer']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
          </td>
            </tr>
            <?php
            endwhile;
            }
            } else {
            $tampil = mysqli_query($koneksi, "SELECT *
            FROM transaksi_customer 
            JOIN tabel_customer ON transaksi_customer.kode_customer = tabel_customer.kode_customer
          JOIN tabel_menu on transaksi_customer.kode_menu = tabel_menu.kode_menu
          JOIN tabel_karyawan on transaksi_customer.kode_karyawan = tabel_karyawan.kode_karyawan
            
            ;");
            if(mysqli_num_rows($tampil)==0){
            echo '<tr><td colspan="5">Tidak ada data</td></tr>';
          }else{
          while($data = mysqli_fetch_array($tampil)) :
          ?>
          
          <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['kode_transcustomer']; ?></td>

                <td><?= $data['kode_customer']; ?></td>
                <td><?= $data['first_name']; ?></td>
                <td><?= $data['kode_menu']; ?></td>
                <td><?=$data['nama_makanan']?></td> 
                <td><?=$data['harga_satuan']?></td>
                <td><?= $data['ketersediaan_menu']; ?></td>

                <td><?= $data['nomor_meja']; ?></td>

                <td><?= $data['kode_karyawan']; ?></td>
                <td><?= $data['Nama_Karyawan']; ?></td>

                <td><?= $data['banyak']; ?></td>
                <td><?= $data['total_harga']; ?></td>
                <td><?= $data['metode_pembayaran']; ?></td>
                <td><?= $data['tanggal_transaksi']; ?></td>
          <td>
            <a href="transaksi_customer.php?hal=edit&id=<?=$data['kode_transcustomer']?>" class="btn btn-warning">Edit</a>
            <a href="transaksi_customer.php?hal=hapus&id=<?=$data['kode_transcustomer']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
          </td>
          </tr>
          <?php
                     endwhile;
                   }
                 }
               ?>
          </table>
     
    </div>
  </div>

<!-- Akhir Card Table -->
</div>
<script src="bootstrap.min.js"></script>  

</body>
</html>