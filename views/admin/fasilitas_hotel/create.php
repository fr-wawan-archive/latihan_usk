<?php
include_once("../../../layouts/admin/inc/header.php");
include_once("../../../layouts/admin/inc/navbar.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    die();
}
?>

<?php
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);

    $query = mysqli_query($conn, "INSERT INTO fasilitas_hotel (nama) VALUES ('$nama')");

    if ($query > 0) {
        alert('Berhasil Menambah Data', 'index.php');
    } else {
        alert('Gagal Menambah Data', 'create.php');
    }
}
?>

<h2>Tambah Fasilitas Hotel</h2>

<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required>
    </div>

    <button type="submit" name="submit">
        Submit
    </button>
</form>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>