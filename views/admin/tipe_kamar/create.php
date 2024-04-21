<?php
include_once("../../../layouts/admin/inc/header.php");
include_once("../../../layouts/admin/inc/navbar.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    die();
}

if ($_SESSION['user']['roles'] != 'admin') {
    header("Location: ../../resepsionis/index.php");
}
?>

<?php
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $jumlah_kamar = htmlspecialchars($_POST['jumlah_kamar']);

    $query = mysqli_query($conn, "INSERT INTO tipe_kamar (nama,jumlah_kamar) VALUES ('$nama','$jumlah_kamar')");

    if ($query > 0) {
        alert('Berhasil Menambah Data', 'index.php');
    } else {
        alert('Gagal Menambah Data', 'create.php');
    }
}
?>

<h2>Tambah Tipe Kamar</h2>

<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required>
    </div>
    <div>
        <label for="jumlah_kamar">Jumlah Kamar</label>
        <input type="text" name="jumlah_kamar" id="jumlah_kamar" required>
    </div>

    <button type="submit" name="submit">
        Submit
    </button>
</form>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>