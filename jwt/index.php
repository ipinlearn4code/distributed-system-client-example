<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("Client.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Aplikasi RESTful</title>
</head>

<body>
    <?php if (isset($_COOKIE['jwt'])) : ?>
        <a href="?page=home">Home</a> |
        <a href="?page=tambah">Tambah Data</a> |
        <a href="?page=daftar-data">Daftar Data</a> |
        <a href="proses.php?aksi=logout" onclick="return confirm('Apakah Anda ingin logout?')">Logout</a>
        <br>
        <strong><?= htmlspecialchars($_COOKIE['nama']) ?> (<?= htmlspecialchars($_COOKIE['id_pengguna']) ?>)</strong>
    <?php else : ?>
        <a href="?page=home">Home</a> |
        <a href="?page=login">Login</a>
    <?php endif; ?>

    <br><br />
    <fieldset>
        <?php
        if ($_GET['page'] === 'login' && !isset($_COOKIE['jwt'])) :
        ?>
            <legend>Login</legend>
            <form action="proses.php" method="post">
                <input type="hidden" name="aksi" value="login">
                <label>Id Pengguna</label>
                <input type="text" name="id_pengguna" required>
                <br>
                <label>Pin</label>
                <input type="password" name="pin" required>
                <br>
                <button type="submit">Login</button>
            </form>
        <?php elseif ($_GET['page'] === 'tambah' && isset($_COOKIE['jwt'])) : ?>
            <legend>Tambah Data</legend>
            <form action="proses.php" method="post">
                <input type="hidden" name="aksi" value="tambah">
                <input type="hidden" name="jwt" value="<?= htmlspecialchars($_COOKIE['jwt']) ?>">
                <label>Id Barang</label>
                <input type="text" name="id_barang" required>
                <br>
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" required>
                <br>
                <button type="submit">Simpan</button>
            </form>
        <?php elseif ($_GET['page'] === 'daftar-data' && isset($_COOKIE['jwt'])) : ?>
            <legend>Daftar Data</legend>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php
                $no = 1;
                $data_array = $abc->tampil_semua_data($_COOKIE['jwt']);
                if (!empty($data_array)) :
                    foreach ($data_array as $data) :
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($data->id_barang) ?></td>
                            <td><?= htmlspecialchars($data->nama_barang) ?></td>
                            <td><a href="?page=ubah&id_barang=<?= htmlspecialchars($data->id_barang) ?>">Ubah</a></td>
                            <td><a href="proses.php?aksi=hapus&id_barang=<?= htmlspecialchars($data->id_barang) ?>&jwt=<?= htmlspecialchars($_COOKIE['jwt']) ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="5">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </table>
        <?php else : ?>
            <legend>Home</legend>
            <p>Selamat datang di aplikasi RESTful sederhana.</p>
        <?php endif; ?>
    </fieldset>
</body>

</html>
