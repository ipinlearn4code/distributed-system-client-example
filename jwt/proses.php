<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("Client.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['aksi'] === 'login') {
        $data = [
            "id_pengguna" => $_POST['id_pengguna'],
            "pin" => $_POST['pin'],
            "aksi" => $_POST['aksi']
        ];
        $response = $abc->login($data);

        if ($response) {
            setcookie('jwt', $response->jwt, time() + 3600, "/");
            setcookie('id_pengguna', $response->id_pengguna, time() + 3600, "/");
            setcookie('nama', $response->nama, time() + 3600, "/");
            header('Location: index.php?page=daftar-data');
        } else {
            header('Location: index.php?page=login');
        }
    } elseif ($_POST['aksi'] === 'tambah') {
        $data = [
            "id_barang" => $_POST['id_barang'],
            "nama_barang" => $_POST['nama_barang'],
            "jwt" => $_POST['jwt'],
            "aksi" => $_POST['aksi']
        ];
        $abc->tambah_data($data);
        header('Location: index.php?page=daftar-data');
    } elseif ($_POST['aksi'] === 'ubah') {
        $data = [
            "id_barang" => $_POST['id_barang'],
            "nama_barang" => $_POST['nama_barang'],
            "jwt" => $_POST['jwt'],
            "aksi" => $_POST['aksi']
        ];
        $abc->ubah_data($data);
        header('Location: index.php?page=daftar-data');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['aksi'] === 'hapus') {
        $data = [
            "id_barang" => $_GET['id_barang'],
            "jwt" => $_GET['jwt'],
            "aksi" => $_GET['aksi']
        ];
        $abc->hapus_data($data);
        header('Location: index.php?page=daftar-data');
    } elseif ($_GET['aksi'] === 'logout') {
        setcookie('jwt', '', time() - 3600, "/");
        setcookie('id_pengguna', '', time() - 3600, "/");
        setcookie('nama', '', time() - 3600, "/");
        header('Location: index.php?page=login');
    }
}
