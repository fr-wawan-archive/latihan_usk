<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'root', 'latihan_usk');

if ($conn->connect_error) {
    printf('Connection Error : ' . $conn->connect_error);
    die();
}
