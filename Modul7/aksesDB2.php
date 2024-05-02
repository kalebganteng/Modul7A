<html>
<!-- Akses databases menggunakan mysql_fetch_row() -->

<head>
    <title>Koneksi Database MySQL</title>
</head>

<body>
    <h1>Koneksi Database dengan mysql_fact_assoc</h1>
    <?php
    $conn = mysqli_connect("localhost", "root", "") or die("Koneksi gagal");
    mysqli_select_db($conn, "latihandb");
    $hasil = mysqli_query($conn, "select * from liga");
    while ($row = mysqli_fetch_array($hasil)) {
        echo "Liga " . $row[1];
        echo " mempunyai " . $row[2];
        echo " wakil di liga champion <br>";
    }
    ?>
</body>

</html>