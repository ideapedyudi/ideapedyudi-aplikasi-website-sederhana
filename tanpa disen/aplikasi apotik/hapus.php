<?php 

// session
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// koneksi
require 'functions.php';

// ambil id dari get
$id = $_GET['id'];

// ambil function hapus
if (hapusObat($id) > 0) {
  echo "
        <script>
          alert('data berhasil dihapus!');
          document.location.href = 'index.php';
        </script>
    ";
} else {
  echo "
        <script>
          alert('data gagal dihapus!');
          document.location.href = 'index.php';
        </script>
    ";
}

?>