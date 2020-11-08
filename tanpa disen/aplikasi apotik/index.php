<?php 

// session
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// koneksi
require 'functions.php';

// query tampil data
$obat = tampilObat("SELECT * FROM obat");


// ketika tombol cari di tekan cari
if (isset($_POST["cari"])) {
  $obat = cariObat($_POST["keyword"]);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi Website Apotik</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    img {
      width: 70px;
    }
  </style>
</head>
<body>
  <!-- ----------------------------------------------------
  # header
  ----------------------------------------------------- -->
  <header>
    <h3>APOTIK SHELOMETA</h3>
    <a href="tambah.php">Tambah Obat</a> |
    <a href="logout.php">Logout</a>
    <br><br>
    <form action="" method="POST">
      <input type="text" name="keyword" size="30" placeholder="cari obat...">
      <button type="submit" name="cari">Cari</button>
    </form><br>
  </header>
  
  <!-- ----------------------------------------------------
  # table obat
  ----------------------------------------------------- -->
  <section>
    <table border="1" cellspacing="0" cellpadding="10">
      <thead>
        <tr>
          <th>No</th>
          <th>Gambar Obat</th>
          <th>Nama Obat</th>
          <th>Detail Obat</th>
          <th>Harga Obat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <?php $i = 1; foreach ($obat as $obt) :?>
      <tbody>
        <tr>
          <td><?= $i++; ?></td>
          <td><img src="img/<?= $obt["gambar_obat"]; ?>" alt=""></td>
          <td><?= $obt["nama_obat"]; ?></td>
          <td><?= $obt["detail_obat"]; ?></td>
          <td><?= $obt["harga_obat"]; ?></td>
          <td>
            <a href="ubah.php?id=<?php echo $obt["id"]; ?>">Ubah</a> |
            <a href="hapus.php?id=<?php echo $obt["id"]; ?>" onclick="return confirm('yakin data akan di hapus');">Hapus</a>
          </td>
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>
  </section>
</body>
</html>