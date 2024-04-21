<?php
include_once("../../../config/functions.php");
include_once("../../../config/helpers.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    die();
}

$query = mysqli_query($conn, "DELETE FROM fasilitas_hotel WHERE id = " . $_GET['id']);

alert('Berhasil Menghapus Data', 'index.php');
exit();
