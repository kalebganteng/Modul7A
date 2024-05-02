<html>
<!-- Akses databases menggunakan mysql_fetch_array() -->

<head>
    <title>Koneksi Database MySQL</title>
</head>

<body>
    <h1>Koneksi Database dengan mysql_fact_array</h1>
    <?php
    $conn = mysqli_connect("localhost", "root", "") or die("Koneksi gagal");
    mysqli_select_db($conn, "latihandb");
    $hasil = mysqli_query($conn, "select * from liga");
    while ($row = mysqli_fetch_array($hasil)) {
        echo "Liga " . $row["negara"] . "<br>";
    }
    ?>
</body>

</html>