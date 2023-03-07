<html>
    <body>
        <form method="POST" action="proses.php" onsubmit="showAlert()">
            <table>
                <tr><td>Nama :</td><td><input type="text" name = "nama"></td></tr>
                <tr><td>Tanggal Lahir</td><td><input type="text" name = "tgl"></td></tr>
                <tr><td>Tempat Lahir</td><td><input type="text" name = "tmpt"></td></tr>
                <tr><td>Jenis Kelamin</td><td><input type="text" name = "jkl"></td></tr>
                <tr><td>Alamat</td><td><input type="text" name = "alamat"></td></tr>
                <tr><td>No HP</td><td><input type="text" name = "hp"></td></tr>
                <tr><td>Golongan Darah</td><td><input type="text" name = "gd"></td></tr>
                <tr><td>Status</td><td><input type="text" name = "status"></td></tr>
                <tr><td>Kontrak</td><td><input type="text" name = "kontrak"></td></tr>
                <tr><td>Jabatan</td><td><input type="text" name = "jabatan"></td></tr>
                <tr><td></td><td><input type="submit"></td></tr>
                <tr><td><a href = "template.php"> klik disini untuk ke halaman utama</td><td></td></tr>

    
            </table>
        </form>

        <script>
  function showAlert() {
    alert("Data berhasil disimpan!");
  }
</script>

    </body>
</html>