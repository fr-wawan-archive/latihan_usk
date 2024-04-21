<?php
include_once("../../../layouts/admin/inc/header.php");
include_once("../../../layouts/admin/inc/navbar.php");


if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    die();
}

if ($_SESSION['user']['roles'] != 'admin') {
    header("Location: ../fasilitas_hotel/index.php");
}

$listFasilitas = query("SELECT * FROM fasilitas_hotel");
?>
<h2>List Fasilitas Hotel</h2>
<div>
    <a href="create.php">Create</a>
    <table width="100%" border="1" style="border-collapse: collapse;margin-top: 1rem;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Action</th>
        </tr>

        <?php foreach ($listFasilitas as $no => $fasilitas) : ?>
            <tr>
                <td><?= $no + 1 ?></td>
                <td>
                    <?= $fasilitas['nama'] ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $fasilitas['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $fasilitas['id'] ?>" onclick="return confirm('Apakah Kamu Yakin?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
include_once("../../../layouts/admin/inc/footer.php");
?>