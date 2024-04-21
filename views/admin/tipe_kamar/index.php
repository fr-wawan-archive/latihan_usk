<?php
include_once("../../../layouts/admin/inc/header.php");
include_once("../../../layouts/admin/inc/navbar.php");


if ($_SESSION['user']['roles'] != 'admin') {
    header("Location: ../../resepsionis/index.php");
}

$listTipeKamar = query("SELECT * FROM tipe_kamar");
?>
<h2>List Tipe Kamar</h2>
<div>
    <a href="create.php">Create</a>
    <table width="100%" border="1" style="border-collapse: collapse;margin-top: 1rem;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah Kamar</th>
            <th>Action</th>
        </tr>

        <?php foreach ($listTipeKamar as $no => $tipeKamar) : ?>
            <tr>
                <td><?= $no + 1 ?></td>
                <td>
                    <?= $tipeKamar['nama'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $tipeKamar['jumlah_kamar'] ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $tipeKamar['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $tipeKamar['id'] ?>" onclick="return confirm('Apakah Kamu Yakin?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>