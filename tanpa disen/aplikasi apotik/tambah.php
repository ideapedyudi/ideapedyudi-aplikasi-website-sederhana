<?php 

// session
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// koneksi
require 'functions.php';

// ketika tombol tambah di tekan
if (isset($_POST['tambah'])) {
   // cek apakah data berhasil di tambahkan atau tidak
   if (tambahObat($_POST) > 0) {
    echo "
        <script>
          alert('data berhasil ditambahkan!');
          document.location.href = 'index.php';
        </script>
    ";
  } else {
    echo "
        <script>
          alert('data gagal ditambahkan!');
          document.location.href = 'index.php';
        </script>
    ";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Obat Apotik</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>
</head>
<body>
  <!-- ----------------------------------------------------
  # header
  ----------------------------------------------------- -->
  <header>
      <h3>Tambah Obat Apotik</h3>
  </header>
  
  <!-- ----------------------------------------------------
  # form tambah data
  ----------------------------------------------------- -->
  <form action="" method="POST" enctype="multipart/form-data">
    <ul>
      <li>
        <label for="gambar_obat">Gambar Obat :</label>
        <input type="file" name="gambar_obat" id="gambar_obat">
      </li>
      <li>
        <label for="nama_obat">Nama Obat :</label>
        <input type="text" name="nama_obat" id="nama_obat">
      </li>
      <li>
        <label for="detail_obat">Detail Obat :</label>
        <input type="text" name="detail_obat" id="detail_obat">
      </li>
      <li>
        <label for="harga_obat">Harga Obat :</label>
        <input type="text" name="harga_obat" id="harga_obat">
      </li>
      <li>
        <button type="submit" name="tambah">Tambah Data</button>
      </li>
    </ul>
  </form>
</body>
</html>