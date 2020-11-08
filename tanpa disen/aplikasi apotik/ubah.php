<?php 

// session
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// koneksi
require 'functions.php';

// ambil id dari Get
$id = $_GET['id'];
$obt = tampilObat("SELECT * FROM obat WHERE id = $id ")[0];

// ketika tombol
if (isset($_POST['ubah'])) {
  if (ubahObat($_POST) > 0) {
    echo "
    <script>
      alert('data berhasil diubah!');
      document.location.href = 'index.php';
    </script>
  ";
  } else {
    echo "
    <script>
      alert('data gagal diubah!');
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
  <title>Ubah Data Apotik</title>
</head>
<body>
  <!-- ----------------------------------------------------
  # header
  ----------------------------------------------------- -->
  <h3>Ubah Data Apotik</h3>
  
  <!-- ----------------------------------------------------
  # form ubah data
  ----------------------------------------------------- -->
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $obt['id']; ?>">
    <input type="hidden" name="gambarLama" value="<?= $obt['gambar_obat']; ?>">
    <ul>
      <li>
        <label for="gambar_obat">Gambar Obat :</label><br>
        <img src="img/<?= $obt['gambar_obat']; ?>" alt="" width="50"><br>
        <input type="file" name="gambar_obat" id="gambar_obat">
      </li>
      <li>
        <label for="nama_obat">Nama Obat :</label>
        <input type="text" name="nama_obat" id="nama_obat" value="<?= $obt['nama_obat']; ?>">
      </li>
      <li>
        <label for="detail_obat">Detail Obat :</label>
        <input type="text" name="detail_obat" id="detail_obat" value="<?= $obt['detail_obat']; ?>">
      </li>
      <li>
        <label for="harga_obat">Harga Obat :</label>
        <input type="text" name="harga_obat" id="harga_obat" value="<?= $obt['harga_obat']; ?>">
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data</button>
      </li>
    </ul>
  </form>
</body>
</html>