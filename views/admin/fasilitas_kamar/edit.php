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

$tipeKamar = query("SELECT * FROM tipe_kamar");
$fasilitas = query("SELECT * FROM fasilitas_kamar WHERE id = " . $_GET['id'])[0];
?>

<?php
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $tipe_kamar_id = htmlspecialchars($_POST['tipe_kamar_id']);

    $query = mysqli_query($conn, "UPDATE fasilitas_kamar SET nama = '$nama',tipe_kamar_id = $tipe_kamar_id WHERE id = " . $_GET['id']);

    if ($query > 0) {
        alert('Berhasil Mengubah Data', 'index.php');
    } else {
        alert('Gagal Mengubah Data', 'create.php');
    }
}
?>

<h2>Tambah Fasilitas Kamar</h2>

<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required value="<?= $fasilitas['nama'] ?>">
    </div>
    <div>
        <label for="tipe_kamar_id">Tipe Kamar</label>
        <select name="tipe_kamar_id" id="tipe_kamar_id">
            <?php foreach ($tipeKamar as $tipe) : ?>
                <option value="<?= $tipe['id'] ?>" <?php if ($tipe['id'] == $fasilitas['tipe_kamar_id']) : ?> selected <?php endif; ?>><?= $tipe['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" name="submit">
        Submit
    </button>
</form>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>