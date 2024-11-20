<?php
error_reporting(1);
include 'client.php';

if (isset($_POST['aksi'])) 
{
    if($_POST['aksi'] == 'tambah')
    {
        $data = array(
            'id_barang' => $_POST['id_barang'],
            'nama_barang' => $_POST['nama_barang'],
        );
        $abc->tambah_data($data);
        header('location: index.php?page=daftar-data');
    }
    else if($_POST['aksi'] == 'ubah'){
        $data = array(
            'id_barang' => $_POST['id_barang'],
            'nama_barang' => $_POST['nama_barang'],
        );
        $abc->ubah_data($data);
        header('location: index.php?page=daftar-data');
    }
    else if($_POST['aksi'] == 'hapus'){
        $data = array(
            'id_barang' => $_POST['id_barang'],
        );
        $abc->hapus_data($data);
        header('location: index.php?page=daftar-data');
    }
}