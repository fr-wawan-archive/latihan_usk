<?php
include_once("../../../layouts/admin/inc/header.php");
include_once("../../../layouts/admin/inc/navbar.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    die();
}

$fasilitas = query("SELECT * FROM fasilitas_hotel WHERE id = " . $_GET['id'])[0];

if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);

    $query = mysqli_query($conn, "UPDATE fasilitas_hotel SET nama = '$nama' WHERE id = " . $_GET['id']);

    if ($query > 0) {
        alert('Berhasil Mengubah Data', 'index.php');
    } else {
        alert('Gagal Mengubah Data', 'create.php');
    }
}
?>

<h2>Tambah Fasilitas Hotel</h2>

<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required value="<?= $fasilitas['nama'] ?>">
    </div>

    <button type="submit" name="submit">
        Submit
    </button>
</form>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>