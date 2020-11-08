<?php  

// session
session_start();
if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

// koneksi
require 'functions.php';

// ketika tombol login di tekan
if (isset($_POST['login'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    
    // cek username
    if (mysqli_num_rows($result) === 1) {
      // cek passwordnya
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
        // set session
        $_SESSION["login"] = true;

        header("Location: index.php");
        exit;
      }
    }

    $error = true;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>
</head>
<body>
  <h3>Registrasi</h3>
  <?php if(isset($error)) : ?>
      <p style="font-style: italic;color: red;">username atau password salah</p>
  <?php endif; ?>
  <form action="" method="POST">
    <ul>
      <li>
        <label for="username">Username :</label>
        <input type="text" name="username" id="username">
      </li>
      <li>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password">
      </li>
      <li>
        <button type="submit" name="login">Login</button>
      </li>
    </ul>
  </form>
</body>
</html>