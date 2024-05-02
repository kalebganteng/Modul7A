<?php
include 'koneksi.php';

// Fungsi untuk menyimpan data tamu
function simpanTamu($nama, $email, $isi, $koneksi) {
    $query = "INSERT INTO Pratikum7 (NAMA, EMAIL, ISI) VALUES ('$nama', '$email', '$isi')";
    $result = $koneksi->query($query);
    if (!$result) {
        die("Error: " . $koneksi->error);
    }
}

// Fungsi untuk menampilkan daftar tamu
function tampilkanTamu($koneksi) {
    $query = "SELECT * FROM Pratikum7";
    $result = $koneksi->query($query);
    if ($result->num_rows > 0) {
        echo "<h2>Daftar Tamu:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "Nama: " . $row["Nama"] . "<br>";
            echo "Email: " . $row["Email"] . "<br>";
            echo "Isi: " . $row["ISI"] . "<br><hr>";
        }
    } else {
        echo "Belum ada tamu yang mengisi buku tamu.";
    }
}

// Proses simpan data tamu jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $isi = $_POST["isi"];
    simpanTamu($nama, $email, $isi, $koneksi);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pratikum7</title>
</head>
<body>
    <h1>Buku Tamu</h1>
    <h2>Tambah Tamu:</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nama: <input type="text" name="nama"><br><br>
        Email: <input type="text" name="email"><br><br>
        Isi: <textarea name="isi"></textarea><br><br>
        <input type="submit" value="Simpan">
    </form>
    <?php tampilkanTamu($koneksi); ?>
</body>
</html>
