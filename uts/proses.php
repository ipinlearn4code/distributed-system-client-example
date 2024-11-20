<?php
// error_reporting(1);
// include("Client.php");

// if ($_POST['aksi'] == 'tambah') {
//     $data = array("id_barang" => $_POST['id_barang'], "nama_barang" => $_POST['nama_barang']);
//     $abc->tambah_data($data);
//     header('location:index.php?page=daftar-data');
// } elseif ($_POST['aksi'] == 'ubah') {
//     $data = array("id_barang" => $_POST["id_barang"], "nama_barang" => $_POST["nama_barang"]);
//     $abc->ubah_data($data);
//     header('location:index.php?page=daftar-data');
// } elseif ($_GET['aksi'] == 'hapus') {
//     $abc->hapus_data($_GET['id_barang']);
//     header('location:index.php?page=daftar-data');
// }

error_reporting(1);
include("Client.php");

if ($_POST['aksi'] == 'tambah') {
    echo 'Method tambah hit';
    $data = array(
        "no_buku" => $_POST['no_buku'],
        "judul" => $_POST['judul'],
        "pengarang" => $_POST['pengarang'],
        "tahun_terbit" => $_POST['tahun_terbit'],
        "penerbit" => $_POST['penerbit'],
        "kategori" => $_POST['kategori']
    );
    $abc->tambah_data($data);
    var_dump($data);
    header('location:index.php?page=daftar-data');
} elseif ($_POST['aksi'] == 'ubah') {
    echo 'Ubah data hit';
    $data = array(
        "no_buku" => $_POST['no_buku'],
        "judul" => $_POST['judul'],
        "pengarang" => $_POST['pengarang'],
        "tahun_terbit" => $_POST['tahun_terbit'],
        "penerbit" => $_POST['penerbit'],
        "kategori" => $_POST['kategori']
    );
    $abc->tambah_data($data);
    $abc->ubah_data($data);
    header('location:index.php?page=daftar-data');
} elseif ($_GET['aksi'] == 'hapus') {
    $abc->hapus_data($_GET['no_buku']);
    header('location:index.php?page=daftar-data');
}
