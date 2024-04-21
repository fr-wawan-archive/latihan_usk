<?php
include_once('../../layouts/admin/login-header.php');


if (isset($_SESSION['user'])) {
    header("Location: tipe_kamar/index.php");
}

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = mysqli_fetch_assoc($query);

        if ($_SESSION['user']['roles'] == 'admin') {
            header('Location: ' . 'tipe_kamar/index.php');
        } else {
            header('Location: ' . '/views/resepsionis/index.php');
        }
    } else {
        echo '<script>alert("Login Gagal!")</script>';
    }
}
?>

<form method="post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <button type="submit" name="submit">Submit</button>
    </div>
</form>

<?php
include_once("../../layouts/admin/login-footer.php");
?>