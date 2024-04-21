<?php
include_once("../../../config/functions.php");
include_once("../../../config/helpers.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    die();
}

if ($_SESSION['user']['roles'] != 'admin') {
    header("Location: ../../resepsionis/index.php");
}

$query = mysqli_query($conn, "DELETE FROM fasilitas_kamar WHERE id = " . $_GET['id']);

alert('Berhasil Menghapus Data', 'index.php');
exit();
