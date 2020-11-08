<?php 

// koneksi
require "functions.php";

// ketika tombol register di tekan
if (isset($_POST['register'])) {
  if (registrasi($_POST) > 0) {
    echo "
            <script>
              alert('user baru berhasil di tambahkan');
            </script>
    ";
  } else {
    echo mysqli_error($conn);
  }
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
        <label for="password2">Konfirmasi password :</label>
        <input type="password" name="password2" id="password2">
      </li>
      <li>
        <button type="submit" name="register">Registrasi</button>
      </li>
    </ul>
  </form>
</body>
</html>