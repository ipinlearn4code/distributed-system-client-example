<?php
include "client.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "nim" => $_POST['nim'],
        "nama" => $_POST['nama'],
        "no_hp" => $_POST['no_hp'],
        "alamat" => $_POST['alamat']
    );
    $objek->tambah_data($data);
    header('location:index.php?page=daftar-server');
} elseif ($_POST['aksi'] == 'ubah') {
    $data = array(
        "nim" => $_POST['nim'],
        "nama" => $_POST['nama'],
        "no_hp" => $_POST['no_hp'],
        "alamat" => $_POST['alamat']
    );
    $objek->ubah_data($data);
    header('location:index.php?page=daftar-server');
} elseif ($_GET['aksi'] == 'hapus') {
    $objek->hapus_data($_GET['nim']);
    header('location:index.php?page=daftar-server');
} elseif ($_POST['aksi'] == 'sinkronisasi') {
    $objek->sinkronisasi();
    header('location:index.php?page=daftar-client');
}

unset($data, $objek);
?>
