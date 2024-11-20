<?php
error_reporting(1);
include("Client.php");
?>
<!doctype html>
<html>

<head>
    <title>CRUD Data Buku</title>
</head>

<body>
    <a href="?page=home">Home</a>|<a href="?page=tambah">Tambah Data</a>|<a href="?page=daftar-data">Daftar Server</a>
    <br><br />
    <?php if ($_GET['page'] == 'tambah') { ?>
        <legend>Tambah Data Buku</legend>
        <form name="form" action="proses.php" method="post">
            <input type="hidden" name="aksi" value="tambah" />
            <label>No Buku</label>
            <input type="text" name="no_buku" disabled />
            <br />
            <label>Judul Buku</label>
            <input type="text" name="judul" />
            <br />
            <label>Pengarang</label>
            <input type="text" name="pengarang" />
            <br />
            <label>Tahun Terbit</label>
            <input type="text" name="tahun_terbit" />
            <br />
            <label>Penerbit</label>
            <input type="text" name="penerbit" />
            <br />
            <label>Kategori</label>
            <input type="text" name="kategori" />
            <br />
            <button type="submit" name="simpan">Simpan</button>
        </form>
    <?php } elseif ($_GET['page'] == 'ubah') {
        $r = $abc->tampil_data($_GET['no_buku']);
        ?>
        <legend>Ubah Data Buku</legend>
        <form name="form" method="post" action="proses.php">
            <input type="hidden" name="aksi" value="ubah" />
            <input type="hidden" name="no_buku" value="<?= $r['no_buku'] ?>" />
            <label>No Buku</label>
            <input type="text" value="<?= $r['no_buku'] ?>" disabled>
            <br />
            <label>Judul Buku</label>
            <input type="text" name="judul" value="<?= $r['judul'] ?>">
            <br />
            <label>Pengarang</label>
            <input type="text" name="pengarang" value="<?= $r['pengarang'] ?>">
            <br />
            <label>Tahun Terbit</label>
            <input type="text" name="tahun_terbit" value="<?= $r['tahun_terbit'] ?>">
            <br />
            <label>Penerbit</label>
            <input type="text" name="penerbit" value="<?= $r['penerbit'] ?>">
            <br />
            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= $r['kategori'] ?>">
            <br />
            <button type="submit" name="ubah">Ubah</button>
        </form>
        <?php unset($r);
    } elseif ($_GET['page'] == 'daftar-data') { ?>
        <legend>Daftar Buku di Server</legend>
        <table border="1">
            <tr>
                <th width="5%">No</th>
                <th width="10%">No Buku</th>
                <th width="20%">Judul</th>
                <th width="15%">Pengarang</th>
                <th width="10%">Tahun Terbit</th>
                <th width="15%">Penerbit</th>
                <th width="10%">Kategori</th>
                <th width="5%" colspan="2">Aksi</th>
            </tr>
            <?php $no = 1;
            $data_array = $abc->tampil_semua_data();
            foreach ($data_array as $r) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $r['no_buku'] ?></td>
                    <td><?= $r['judul'] ?></td>
                    <td><?= $r['pengarang'] ?></td>
                    <td><?= $r['tahun_terbit'] ?></td>
                    <td><?= $r['penerbit'] ?></td>
                    <td><?= $r['kategori'] ?></td>
                    <td><a href="?page=ubah&no_buku=<?= $r['no_buku'] ?>">Ubah</a></td>
                    <td><a href="proses.php?aksi=hapus&no_buku=<?= $r['no_buku'] ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
                </tr>
                <?php $no++;
            }
            unset($data_array, $r, $no); ?>
        </table>
    <?php } else { ?>
        <legend>Home</legend>
        Aplikasi sederhana ini menggunakan SOAP
    <?php } ?>
</body>

</html>
