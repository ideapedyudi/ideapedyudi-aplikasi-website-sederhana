<?php 

// hapus session
session_start();
session_destroy();

// kembali ke login
header("Location: login.php");

?>