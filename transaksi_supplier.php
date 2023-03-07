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
      $edit = mysqli_query($koneksi, "UPDATE transaksi_supplier set
                                      kode_transaksi = '$_POST[btnkode]',
                                      kode_supplier = '$_POST[btnkode_supplier]',
                                      kode_bahan = '$_POST[btnkode_bahan]',
                                      jumlah = '$_POST[btnjumlah]',
                                      total_transaksi = '$_POST[btntransaksi]',
                                      total_bayar = '$_POST[btntotal]',
                                      kembalian = '$_POST[btnkembalian]',
                                      tanggal_transaksi = '$_POST[btntanggal_transaksi]'
                                      WHERE kode_transaksi = '$_GET[id]' 
                                      ");

        if($edit) { // jika edit sukses
          echo "<script>
                    alert('Edit Data Sukses!');
                    document.location= 'transaksi_supplier.php';
              </script>";
        } else { // jika edit gagal
          echo "<script>
                    alert('edit Data Gagal!');
                    document.location= 'transaksi_supplier.php';
              </script>";
        }

    } else {
      // Data akan disempan sebagai data baru
      $simpan = mysqli_query($koneksi, "INSERT INTO transaksi_supplier (kode_transaksi, kode_supplier, kode_bahan,  jumlah, total_transaksi, total_bayar, kembalian, tanggal_transaksi)
                                      VALUES ('$_POST[btnkode]', '$_POST[btnkode_supplier]','$_POST[btnkode_bahan]', '$_POST[btnjumlah]', '$_POST[btntransaksi]', '$_POST[btntotal]', '$_POST[btnkembalian]', '$_POST[btntanggal_transaksi]')
                                      ");

      if($simpan) {
        echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location= 'transaksi_supplier.php';
            </script>";
      } else {
        echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location= 'transaksi_supplier.php';
            </script>";
      }
    }
    
  }

  // uji tombol uji dan hapus
  if(isset($_GET['hal'])) { // jika hal tidak kosong maka akan
    // pengujian data edit
    if($_GET['hal'] == "edit") {
      // tampilkan data yang telah diedit
      $tampil = mysqli_query($koneksi, "SELECT * FROM transaksi_supplier;" );
      $data = mysqli_fetch_array($tampil);
      if($data) {
        // jika data ditemukan, maka data ditampunggu dulu dalam variabel
        $vkode = $data['kode_transaksi'];
        $vkode_supplier = $data['kode_supplier'];
        $vkode_bahan = $data['kode_bahan'];
        $vjumlah = $data['jumlah'];
        $vkaryawan = $data['total_transaksi'];
        $vtotal_bayar = $data['total_bayar'];
        $vkembalian = $data['kembalian'];
        $vtanggal_transaksi = $data['tanggal_transaksi'];
    } 
    } else if ($_GET['hal'] == 'hapus') {
       // pengujian hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM transaksi_supplier where kode_transaksi = '$_GET[id]' " );
       if ($hapus) {
        echo "<script>
            alert('Data Telah Dihapus!');
            document.location= 'transaksi_supplier.php';
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
          <label for="kode_transaksi">Kode Transaksi</label>
          <input type="text" name="btnkode" value="<?=@$vkode?>" class="form-control" placeholder="inputkan Nama Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_bahan">Kode Supplier</label>
          <input type="text" name="btnkode_supplier" value="<?=@$vkode_supplier?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="kode_bahan">Kode bahan</label>
          <input type="text" name="btnkode_bahan" value="<?=@$vkode_bahan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="jumlah">Jumlah</label>
          <input type="number" name="btnjumlah" value="<?=@$vjumlah?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="jumlah">total transaksi</label>
          <input type="number" name="btntransaksi" value="<?=@$vkaryawan?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="jumlah">Total Bayar</label>
          <input type="number" name="btntotal" value="<?=@$vtotal_bayar?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="jumlah">Kembalian</label>
          <input type="number" name="btnkembalian" value="<?=@$vkembalian?>" class="form-control" placeholder="inputkan Harga Produk Disini" required>
        </div>
        <div class='form-group'>
          <label for="jumlah">Tanggal Transaksi</label>
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
            <td><input type="date" name='darikembalian' class="ml-2 mr-2" required></td>
            <td>Tanggal Selesai</td>
            <td><input type="date" name='sampaikembalian' class="ml-2 mr-3" required></td>
            <td><input type="submit" class='btn btn-info' name='filter' value='Filter'></td>
          </tr>
        </table>
      </form>
      <br>
      <table class="table table-bordered table-striped">
        <tr>
          <th>no</th>
          <th>Kode Transaksi</th>
          <th>Kode Supplier</th>
          <th>Nama Supplier</th>
          <th>Alamat</th>
         

          <th>Kode bahan</th>
          <th>Nama Bahan</th>
          <th>Kategori</th>

          <th>Jumlah</th>
          <th>Total Transaksi</th>
          <th>Total Bayar</th>
          <th>Kembalian</th>
          <th>Tanggal Transaksi</th>
        </tr>
        <?php
          $no = 1;
          $tampil= mysqli_query($koneksi, "SELECT *
          FROM transaksi_supplier 
          JOIN tabel_bahan ON transaksi_supplier.kode_bahan = tabel_bahan.kode_bahan
          JOIN tabel_supplier on transaksi_supplier.kode_supplier = tabel_supplier.kode_supplier
          ;");
          if(isset($_GET['filter'])) {
            $darikembalian = mysqli_real_escape_string($koneksi, $_GET['darikembalian']);
            $sampaikembalian = mysqli_real_escape_string($koneksi, $_GET['sampaikembalian']);
            $tampil = mysqli_query($koneksi, "SELECT * FROM transaksi_supplier JOIN tabel_bahan ON transaksi_supplier.kode_bahan = tabel_bahan.kode_bahan
         JOIN tabel_supplier on transaksi_supplier.kode_supplier = tabel_supplier.kode_supplier   WHERE tanggal_transaksi BETWEEN '$darikembalian' AND '$sampaikembalian' ");
            if(mysqli_num_rows($tampil)==0){
            echo '<tr><td align="center" colspan="5">Tidak ada data</td></tr>';
            }else{
            while($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['kode_transaksi']; ?></td>
            <td><?= $data['kode_supplier']; ?></td>
            
            <td><?=$data['nama_supplier']?></td> 
           <td><?=$data['alamat']?></td>
            
            <td><?= $data['kode_bahan']; ?></td>
            <td><?= $data['nama_bahan']; ?></td>
            <td><?= $data['kategori']; ?></td>
      
            
            <td><?= $data['jumlah']; ?></td>
           
            <td><?= $data['total_transaksi']; ?></td>
            <td><?= $data['total_bayar']; ?></td>
            <td><?= $data['kembalian']; ?></td>
            <td><?= $data['tanggal_transaksi']; ?></td>
            

            <td>
            <a href="transaksi_supplier.php?hal=edit&id=<?=$data['kode_transaksi']?>" class="btn btn-warning">Edit</a>
            <a href="transaksi_supplier.php?hal=hapus&id=<?=$data['kode_transaksi']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
          </td>
            </tr>
            <?php
            endwhile;
            }
            } else {
            $tampil = mysqli_query($koneksi, "SELECT *
            FROM transaksi_supplier 
            JOIN tabel_bahan ON transaksi_supplier.kode_bahan = tabel_bahan.kode_bahan
            JOIN tabel_supplier on transaksi_supplier.kode_supplier = tabel_supplier.kode_supplier
            ;");
            if(mysqli_num_rows($tampil)==0){
            echo '<tr><td colspan="5">Tidak ada data</td></tr>';
          }else{
          while($data = mysqli_fetch_array($tampil)) :
          ?>
          
          <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['kode_transaksi']; ?></td>
          <td><?= $data['kode_supplier']; ?></td>
            
          <td><?=$data['nama_supplier']?></td> 
          <td><?=$data['alamat']?></td>
            
          <td><?= $data['kode_bahan']; ?></td>
          <td><?= $data['nama_bahan']; ?></td>
          <td><?= $data['kategori']; ?></td>
      
            
          <td><?= $data['jumlah']; ?></td>
           
          <td><?= $data['total_transaksi']; ?></td>
          <td><?= $data['total_bayar']; ?></td>
          <td><?= $data['kembalian']; ?></td>
          <td><?= $data['tanggal_transaksi']; ?></td>
          <td>
            <a href="transaksi_supplier.php?hal=edit&id=<?=$data['kode_transaksi']?>" class="btn btn-warning">Edit</a>
            <a href="transaksi_supplier.php?hal=hapus&id=<?=$data['kode_transaksi']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data?')" class="btn btn-danger">Hapus</a>
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