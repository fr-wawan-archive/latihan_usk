<?php
include('database.php');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function updateStatusReservasi($status, $id_reservasi)
{
    global $conn;
    $query = mysqli_query($conn, "UPDATE reservasi SET status = '$status' WHERE id = $id_reservasi");

    return $query;
}
