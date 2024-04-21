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

$fasilitasKamar = query("SELECT f.id, f.nama AS nama_fasilitas,t.nama AS nama_kamar FROM fasilitas_kamar f LEFT JOIN tipe_kamar t ON f.tipe_kamar_id = t.id");
?>

<h2>List Fasilitas Kamar</h2>
<div>
    <a href="create.php">Create</a>
    <table width="100%" border="1" style="border-collapse: collapse;margin-top: 1rem;">
        <tr>
            <th>No</th>
            <th>Nama Kamar</th>
            <th>Fasilitas</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($fasilitasKamar as $no => $fasilitas) : ?>
            <tr>
                <td><?= $no + 1 ?></td>
                <td>
                    <?= $fasilitas['nama_kamar'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $fasilitas['nama_fasilitas'] ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $fasilitas['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $fasilitas['id'] ?>" onclick="return confirm('Apakah Kamu Yakin?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>