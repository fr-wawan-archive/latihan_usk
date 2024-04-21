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

$tipeKamar = query("SELECT * FROM tipe_kamar WHERE id = " . $_GET['id'])[0];


if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $jumlah_kamar = htmlspecialchars($_POST['jumlah_kamar']);
    $fasilitas = htmlspecialchars($_POST['fasilitas']);

    $query = mysqli_query($conn, "UPDATE tipe_kamar SET nama = '$nama',jumlah_kamar='$jumlah_kamar',fasilitas='$fasilitas' WHERE id = " . $_GET['id']);

    if ($query > 0) {
        alert('Berhasil Mengubah Data', 'index.php');
    } else {
        alert('Gagal Mengubah Data', 'create.php');
    }
}
?>

<h2>Edit Tipe Kamar : <?= $tipeKamar['nama'] ?></h2>

<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required value="<?= $tipeKamar['nama'] ?>">
    </div>
    <div>
        <label for="jumlah_kamar">Jumlah Kamar</label>
        <input type="text" name="jumlah_kamar" id="jumlah_kamar" required value="<?= $tipeKamar['jumlah_kamar'] ?>">
    </div>

    <button type="submit" name="submit">
        Submit
    </button>
</form>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>