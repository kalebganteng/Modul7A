<?php
// File: koneksi.php

class Koneksi
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "latihandb";
    protected $conn;

    // Konstruktor untuk membuat koneksi
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

// File: buku_tamu.php

require_once 'koneksi.php';

class BukuTamu extends Koneksi
{
    // Fungsi untuk menambahkan pesanan baru
    public function tambahPesanan($nama, $email, $isi)
    {
        $sql = "INSERT INTO buku_tamu (nama, email, isi) VALUES ('$nama', '$email', '$isi')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    // Fungsi untuk menampilkan semua pesanan
    public function tampilkanPesanan()
    {
        $sql = "SELECT * FROM buku_tamu";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["ID_BT"] . " - Nama: " . $row["nama"] . " - Email: " . $row["email"] . " - Pesan: " . $row["isi"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }
}

// Menambahkan pesanan jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buku_tamu = new BukuTamu();
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $isi = $_POST["isi"];

    $result = $buku_tamu->tambahPesanan($nama, $email, $isi);
    if ($result === true) {
        echo "Data berhasil ditambahkan ke dalam buku tamu.";
    } else {
        echo $result;
    }
}
?>

<html>

<head>
    <title>Buku Tamu</title>
</head>

<body>
    <h1>Buku Tamu</h1>

    <!-- Formulir untuk input data -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nama: <input type="text" name="nama"><br>
        Email: <input type="text" name="email"><br>
        Isi Pesan: <textarea name="isi"></textarea><br>
        <input type="submit" value="Kirim">
    </form>

    <!-- Tombol untuk menampilkan semua pesanan -->
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="aksi" value="tampilkan">
        <input type="submit" value="Cek Pesanan">
    </form>

    <?php
    // Tampilkan semua pesanan jika tombol "Cek Pesanan" ditekan
    if (isset($_GET['aksi']) && $_GET['aksi'] == 'tampilkan') {
        $buku_tamu = new BukuTamu();
        echo "<h2>Semua Pesanan:</h2>";
        $buku_tamu->tampilkanPesanan();
    }
    ?>
</body>

</html>