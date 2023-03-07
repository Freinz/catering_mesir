<?php
if ($_POST){
    $name = $_POST['nama'];
    $tanggal = $_POST['tgl'];
    $tempat = $_POST['tmpt'];
    $jkel = $_POST['jkl'];
    $alamat = $_POST['alamat'];
    $Nomor = $_POST['hp'];
    $Goldar = $_POST['gd'];
    $Status = $_POST['status'];
    $Kontrak = $_POST['kontrak'];
    $Jabatan = $_POST['jabatan'];
    if(empty($name)){
        echo "Data harus diisi";

    }
    else {
        echo 'Nama : ';
        echo $name . '<br>';
        echo 'Tanggal Lahir : ';
        echo $tanggal . '<br>';
        echo 'Tempat Lahir : ';
        echo $tempat . '<br>';
        echo 'Jenis kelamin : ';
        echo $jkel . '<br>';
        echo 'Alamat : ';
        echo $alamat . '<br>';
        echo 'Nomor HP : ';
        echo $Nomor . '<br>';
        echo 'Golongan Darah : ';
        echo $Goldar . '<br>';
        echo 'Status : ';
        echo $Status . '<br>';
        echo 'Kontrak : ';
        echo $Kontrak . '<br>';
        echo 'Jabatan : ';
        echo $Jabatan . '<br>';
        echo '<br>';


        echo '<a href = "tables.php"> klik disini untuk ke halaman input';
    }
}
?>