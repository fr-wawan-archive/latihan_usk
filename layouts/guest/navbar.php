<h2>Hotel Hebat</h2>
<ul>
    <li>
        <a href="/views/home/index.php">Home</a>
    </li>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['roles'] == 'resepsionis') : ?>
        <li>
            <a href="/views/resepsionis/index.php">Resepsionis</a>
        </li>
        <li>
            <a href="/views/admin/logout.php">Logout</a>
        </li>
    <?php endif; ?>
</ul>