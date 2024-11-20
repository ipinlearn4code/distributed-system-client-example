<?php
include "client.php";

if ($_POST['aksi'] == 'tambah') {
	$data = array(
		"nim" => $_POST['nim'],
		"nama" => $_POST['nama'],
		"alamat" => $_POST['alamat'],
		"no_hp" => $_POST['no_hp']
	);
	$objek->tambah_data($data);
	header('location:index.php?page=daftar-server');
} else if ($_POST['aksi'] == 'ubah') {
	$data = array(
		"nim" => $_POST['nim'],
		"nama" => $_POST['nama'],
		"alamat" => $_POST['alamat'],
		"no_hp" => $_POST['no_hp']
	);
	$objek->ubah_data($data);
	header('location:index.php?page=daftar-server');
} else if ($_GET['aksi'] == 'hapus') {
	$objek->hapus_data($_GET['nim']);
	header('location:index.php?page=daftar-server');
} else if ($_POST['aksi'] == 'sinkronisasi') {
	$objek->sinkronisasi();
	header('location:index.php?page=daftar-client');
}

unset($data, $objek);
?>