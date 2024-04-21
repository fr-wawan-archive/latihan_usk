<?php
include_once("../../layouts/guest/header.php");
include_once("../../layouts/guest/navbar.php");
$tipeKamar = query("SELECT t.id,t.jumlah_kamar,GROUP_CONCAT(f.nama) AS fasilitas,t.nama AS nama_kamar FROM tipe_kamar t LEFT JOIN fasilitas_kamar f ON f.tipe_kamar_id = t.id GROUP BY t.id, t.nama");

$fasilitasHotel = query("SELECT * FROM fasilitas_hotel");


if (isset($_POST['submit'])) {
    $check_in = htmlspecialchars($_POST['check_in']);
    $check_out = htmlspecialchars($_POST['check_out']);
    $jumlah_kamar = htmlspecialchars($_POST['jumlah_kamar']);
    $nama_pemesan = htmlspecialchars($_POST['nama_pemesan']);
    $email = htmlspecialchars($_POST['email']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $nama_tamu = htmlspecialchars($_POST['nama_tamu']);
    $tipe_kamar_id = htmlspecialchars($_POST['tipe_kamar_id']);

    $selectedTipeKamar = query("SELECT * FROM tipe_kamar WHERE id = " . $tipe_kamar_id)[0];

    if ($check_in > $check_out) {
        alert("Tanggal Check In Tidak Boleh Melebihi Tanggal Check Out", "index.php");
        return;
    }

    if ($selectedTipeKamar['jumlah_kamar'] < $jumlah_kamar) {
        alert("Jumlah Kamar Yang Tersedia Tidak Mencukupi", "index.php");
        return;
    }

    $sisaJumlahKamar = $selectedTipeKamar['jumlah_kamar'] - $jumlah_kamar;

    $query = mysqli_query($conn, "INSERT INTO reservasi (check_in,check_out,jumlah_kamar,nama_pemesan,email,no_hp,nama_tamu,tipe_kamar_id) VALUES ('$check_in','$check_out',$jumlah_kamar,'$nama_pemesan','$email','$no_hp','$nama_tamu',$tipe_kamar_id)");

    $query = mysqli_query($conn, "UPDATE tipe_kamar SET jumlah_kamar = $sisaJumlahKamar WHERE id = " . $tipe_kamar_id);

    if ($query > 0) {
        alert('Berhasil Reservasi', 'index.php');
    } else {
        alert('Gagal Reservasi', 'index.php');
    }
}
?>
<div>
    <h2 align="center">Tentang Kami</h2>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum, dolor recusandae quasi alias dolorem sed laboriosam perferendis? Non quasi inventore, vitae ullam enim blanditiis, pariatur maiores ea in consectetur excepturi atque voluptatibus alias doloremque architecto molestias adipisci error odio, quos laborum. Corporis praesentium itaque iste doloremque eligendi dolorem consequuntur molestiae animi velit perferendis provident maxime reprehenderit expedita, at, ab unde quos aliquam. Sequi facilis repellat dolores quibusdam ipsum architecto exercitationem aliquam dolorem nulla aut, quae tempora facere? Quia dolores odit illum reiciendis quae exercitationem nobis quo molestiae earum sint facilis nam, deleniti voluptatum culpa esse libero recusandae ipsam, maxime cum!</p>
</div>

<div>
    <h2>Fasilitas Hotel</h2>
    <ul>
        <?php foreach ($fasilitasHotel as $fasilitas) : ?>
            <li><?= $fasilitas['nama'] ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<form method="post">
    <div>
        <label for="check_in">Check In</label>
        <input type="date" name="check_in" id="check_in" min="<?= date('Y-m-d') ?>" required>
    </div>
    <div>
        <label for="check_out">Check Out</label>
        <input type="date" name="check_out" id="check_out" min="<?= date('Y-m-d') ?>" required>
    </div>
    <div>
        <label for="jumlah_kamar">Jumlah Kamar</label>
        <input type="number" name="jumlah_kamar" id="jumlah_kamar" required>
    </div>

    <div>
        <label for="tipe_kamar_id">Tipe Kamar</label>
        <select name="tipe_kamar_id" id="tipe_kamar_id" required>
            <?php foreach ($tipeKamar as $tipe) : ?>
                <option value="<?= $tipe['id'] ?>"><?= $tipe['nama_kamar'] ?> (Kamar Tersedia : <?= $tipe['jumlah_kamar'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="nama_pemesan">Nama Pemesan</label>
        <input type="text" name="nama_pemesan" id="nama_pemesan" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div>
        <label for="no_hp">No Handphone</label>
        <input type="number" name="no_hp" id="no_hp" required>
    </div>
    <div>
        <label for="nama_tamu">Nama Tamu</label>
        <input type="text" name="nama_tamu" id="nama_tamu" required>
    </div>

    <button type="submit" name="submit">Submit</button>
</form>

<div>
    <?php foreach ($tipeKamar as $tipe) : ?>
        <div>
            <h2><?= $tipe['nama_kamar'] ?> (Kamar Tersedia : <?= $tipe['jumlah_kamar'] ?>)</h2>
            <h3>Fasilitas : </h3>
            <ul>
                <?php foreach (explode(',', $tipe['fasilitas']) as $no => $fasilitas) : ?>
                    <li><?= $fasilitas ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>

<?php
include_once("../layouts/guest/footer.php");
?>