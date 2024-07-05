<?php
$servername = "localhost";  // Ganti dengan nama server Anda
$username = "root";     // Ganti dengan username database Anda
$password = "";     // Ganti dengan password database Anda
$dbname = "db_keuangan";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl = $_POST["tgl"];
    $deskripsi = $_POST["deskripsi"];
    $jumlah = $_POST["jumlah"];
    $id_kategori = $_POST["id_kategori"];
    $tipe_transaksiq = $_POST["tipe_transaksi"];

    $sql = "INSERT INTO transactions (tgl, deskripsi, jumlah, id_kategori, tipe_transaksi)
            VALUES ('$tgl', '$deskripsi', $jumlah, $id_kategori, '$tipe_transaksiq')";

    if ($conn->query($sql) === TRUE) {
        echo "Transaksi berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Keuangan</title>
</head>
<body>
    <h2>Tambah Transaksi</h2>
    <form method="POST">
        Tanggal Transaksi: <input type="date" name="tgl"><br>
        Deskripsi: <input type="text" name="deskripsi"><br>
        Jumlah: <input type="number" name="jumlah"><br>
        Kategori:
        <select name="id_kategori">
            <option value="1">Gaji</option>
            <option value="2">Makanan</option>
            <option value="3">Sewa</option>
        </select><br>
        Tipe Transaksi:
        <select name="tipe_transaksi">
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select><br>
        <input type="submit" value="Tambah Transaksi">
    </form>
</body>
</html>

?>