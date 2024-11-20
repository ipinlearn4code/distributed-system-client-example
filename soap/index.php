<?php
error_reporting(1);
include 'Client.php';
?>
<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <a href="?page=home">Home</a> | <a href="?page=tambah">Tambah Data</a> | <a href="?page=daftar-data">Data Server</a>
        <br/><br/>
        <fieldset>
            <?php if ($_GET['page']=='tambah') { ?>
                <legend>Tambah Data</legend>
                <form name="form" method="POST" action="proses.php">
                    <input type="hidden" name="aksi" value="tambah"/>
                    <label>Id Barang</label>
                    <input type="text" name="id_barang"/><br/>
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang"/><br/>
                    <button type="submit" name="simpan">Simpan</button>
                </form>
            <?php } elseif ($_GET['page']=='ubah') {
                $r = $abc->tampil_data($_GET['id_barang']);
            ?>
                <legend>Ubah Data</legend>
                <form name="form" method="post" action="proses.php">
                    <input type="hidden" name="aksi" value="ubah"/>
                    <label>Id Barang</label>
                    <input type="text" value="<?= $r['id_barang'] ?>" disabled/><br/>
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" value="<?= $r['nama_barang'] ?>"/><br/>
                    <button type="submit" name="ubah">Ubah</button>
                </form>
            <?php } elseif ($_GET['page']=='daftar-data') { ?>
                <legend>Daftar Data Server</legend>
                <table border="1">
                    <thead>
                        <th width="5%">No</th>
                        <th width="15%">ID Barang</th>
                        <th width="30%">Nama Barang</th>
                        <th width="7%">Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                            $data = $abc->tampil_semua_data();
                            $no = 1;
                            foreach ($data as $r) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $r['id_barang'] ?></td>
                                <td><?= $r['nama_barang'] ?></td>
                                <td><a href="?page=ubah&id_barang=<?= $r['id_barang'] ?>">Ubah</a> | <a href="proses.php?aksi=hapus&id_barang=<?= $r['id_barang'] ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
                            </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            <?php } ?>
        </fieldset>
        <legend>Note</legend>
        <p>Aplikasi sederhana ini menggunakan Web Service SOAP (Simple Object Access Protocol) dengan format data XML (Extensible Markup Language).</p>
    </body>
</html>
