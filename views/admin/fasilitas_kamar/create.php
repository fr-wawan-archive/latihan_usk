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
?>

<?php
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $tipe_kamar_id = htmlspecialchars($_POST['tipe_kamar_id']);

    $query = mysqli_query($conn, "INSERT INTO fasilitas_kamar (nama,tipe_kamar_id) VALUES ('$nama',$tipe_kamar_id)");

    if ($query > 0) {
        alert('Berhasil Menambah Data', 'index.php');
    } else {
        alert('Gagal Menambah Data', 'create.php');
    }
}
?>

<h2>Tambah Fasilitas Kamar</h2>

<form method="post">
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required>
    </div>
    <div>
        <label for="tipe_kamar_id">Tipe Kamar</label>
        <select name="tipe_kamar_id" id="tipe_kamar_id">
            <?php foreach ($tipeKamar as $tipe) : ?>
                <option value="<?= $tipe['id'] ?>"><?= $tipe['nama'] ?></option>
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