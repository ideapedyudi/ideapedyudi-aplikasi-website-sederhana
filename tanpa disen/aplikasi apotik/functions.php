<?php 



// ----------------------------
  # functios koneksi
// ----------------------------
$conn = mysqli_connect("localhost", "root", "", "database-aplikasi-website-sederhana-apotik");



// ----------------------------
  # functios tampil data
// ----------------------------
function tampilObat($data) {
  global $conn;
  $result = mysqli_query($conn, $data);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}



// ----------------------------
  # functios tambah data
// ----------------------------
function tambahObat($data) {
  global $conn;
  $gambar_obat = uploadObat();
  if (!$gambar_obat) {
    return false;
  }
  $nama_obat = htmlspecialchars($data["nama_obat"]);
  $detail_obat = htmlspecialchars($data["detail_obat"]);
  $harga_obat = htmlspecialchars($data["harga_obat"]);

  $result  = "INSERT INTO obat VALUE('', '$gambar_obat', '$nama_obat', '$detail_obat', '$harga_obat')";
  mysqli_query($conn, $result);
  return mysqli_affected_rows($conn);
}



// ----------------------------
  # functios ubah data
// ----------------------------
function ubahObat($data) {
  global $conn;
  $id = $data["id"];
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar atau tidak
  if ($_FILES['gambar_obat']['error'] === 4) {
    $gambar_obat = $gambarLama;
  } else {
    $gambar_obat = uploadObat();
  }

  $nama_obat = htmlspecialchars($data["nama_obat"]);
  $detail_obat = htmlspecialchars($data["detail_obat"]);
  $harga_obat = htmlspecialchars($data["harga_obat"]);

  $result = "UPDATE obat SET
        gambar_obat = '$gambar_obat',
        nama_obat = '$nama_obat',
        detail_obat = '$detail_obat',
        harga_obat = '$harga_obat'
        WHERE id = $id
  ";

  mysqli_query($conn, $result);
  return mysqli_affected_rows($conn);
}



// ----------------------------
  # functios hapus data
// ----------------------------
function hapusObat($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM obat WHERE id = $id");

  return mysqli_affected_rows($conn);
}



// ----------------------------
  # functios upload data
// ----------------------------
function uploadObat() {
  $namaFile = $_FILES['gambar_obat']['name'];
  $ukuranFile = $_FILES['gambar_obat']['size'];
  $error = $_FILES['gambar_obat']['error'];
  $tmpName = $_FILES['gambar_obat']['tmp_name'];

  // cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "
    <script>
      alert('pilih gambar terlebih dahulu');
    </script>
    ";

    return false;
  }

  // cek apakah yang diupload gambar apa tidak
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "
    <script>
      alert('yang anda aploud bukan gambar!');
    </script>
    ";
    return false;
  }

  // cek ukuran file terlalu besar
  if ($ukuranFile > 1000000) {
    echo "
    <script>
      alert('file terlalu besar!');
    </script>
    ";
    return false;
  }

  // lolos pengecekan
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
  return $namaFileBaru;

}



// ----------------------------
  # functios cari data
// ----------------------------
function cariObat($inputanUser) {
  $result = "SELECT * FROM obat WHERE 
      nama_obat LIKE '%$inputanUser%' OR
      detail_obat LIKE '%$inputanUser%' OR
      harga_obat LIKE '%$inputanUser%'
  ";
  return tampilObat($result);
}



// ----------------------------
  # functios ubah data
// ----------------------------
function registrasi($data) {
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "
          <script>
              alert('username sudah terdaftar');
          </script>
    ";
    return false;
  }

  // cek konfirmasi passswword
  if ($password !== $password2) {
    echo "
          <script>
            alert('konfirmasi password tidak sesuai');
          </script>
    ";
  }
  

  // ckripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambakan ke database
  mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
  return mysqli_affected_rows($conn);

}



?>