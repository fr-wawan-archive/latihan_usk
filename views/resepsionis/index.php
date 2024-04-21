<?php
include_once("../../layouts/guest/header.php");
include_once("../../layouts/guest/navbar.php");
if (!isset($_SESSION['user'])) {
    header("Location: ../admin/login.php");
    die();
}

$query = "SELECT r.id,r.tipe_kamar_id,r.check_in,r.status,r.check_out,r.jumlah_kamar,r.nama_pemesan,r.email,r.no_hp,r.nama_tamu,k.nama AS nama_kamar FROM reservasi r LEFT JOIN tipe_kamar k ON r.tipe_kamar_id = k.id";

$listReservasi = query($query);

if (isset($_POST['check_in'])) {
    updateStatusReservasi("check_in", $_POST['reservasi_id']);

    alert("Berhasil Check In", "index.php");
}

$filter_check_in = $_GET['filter_check_in'];
$filter_nama_tamu = $_GET['filter_nama_tamu'];

if (isset($filter_check_in) && !empty($filter_check_in)) {
    $listReservasi = query($query . " WHERE r.check_in = '$filter_check_in'");
}

if (isset($filter_nama_tamu) && !empty($filter_nama_tamu)) {
    $listReservasi = query($query . " WHERE r.nama_tamu = '$filter_nama_tamu'");
}

if (isset($filter_check_in) && !empty($filter_check_in) && isset($filter_nama_tamu) && !empty($filter_nama_tamu)) {
    $listReservasi = query($query . " WHERE r.nama_tamu = '$filter_nama_tamu' AND r.nama_tamu = '$filter_nama_tamu'");
}

if (isset($_POST['check_out'])) {
    $reservasi_id = $_POST['reservasi_id'];
    updateStatusReservasi("check_out", $reservasi_id);

    $reservasi = query($query . " WHERE r.id = $reservasi_id")[0];
    $tipe_kamar = query("SELECT * FROM tipe_kamar WHERE id = " . $reservasi['tipe_kamar_id'])[0];


    $jumlah_kamar = $reservasi['jumlah_kamar'] + $tipe_kamar['jumlah_kamar'];

    $query = mysqli_query($conn, "UPDATE tipe_kamar SET jumlah_kamar = $jumlah_kamar WHERE id = " . $tipe_kamar['id']);
    alert("Berhasil Check Out", "index.php");
}
?>
<h2>List Reservasi</h2>

<form action="">
    <input type="date" name="filter_check_in" value="<?= $_GET['filter_check_in'] ?>">
    <input type="text" name="filter_nama_tamu" value="<?= $_GET['filter_nama_tamu'] ?>">
    <button>Filter</button>
</form>
<div>
    <table width="100%" border="1" style="border-collapse: collapse;margin-top: 1rem;">
        <tr>
            <th>No</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Nama Kamar</th>
            <th>Jumlah Kamar</th>
            <th>Nama Pemesan</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Nama Tamu</th>
            <th>Action</th>
        </tr>

        <?php foreach ($listReservasi as $no => $reservasi) : ?>
            <tr>
                <td><?= $no + 1 ?></td>
                <td>
                    <?= $reservasi['check_in'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['check_out'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['nama_kamar'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['jumlah_kamar'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['nama_pemesan'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['email'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['no_hp'] ?>
                </td>
                <td style="width: 10%;">
                    <?= $reservasi['nama_tamu'] ?>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" value="<?= $reservasi['id'] ?>" name="reservasi_id">
                        <?php if ($reservasi['status'] == 'pending') : ?>
                            <button type="submit" name="check_in">Check In</button>
                        <?php elseif ($reservasi['status'] == 'check_in') : ?>
                            <button type="submit" name="check_out">Check Out</button>
                        <?php else : ?>
                            <span>Selesai</span>
                        <?php endif ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
include_once("../../layouts/guest/footer.php");
?>