<?php
include '../config/koneksi.php'; // gunakan koneksi dari folder config

// Set header agar file terdeteksi sebagai Excel
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Produk.xls");

// Mulai output tabel
echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Kategori</th>
    </tr>";

$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM produk");

while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$row['nama']}</td>
            <td>{$row['harga']}</td>
            <td>{$row['stok']}</td>
            <td>{$row['kategori']}</td>
        </tr>";
    $no++;
}

echo "</table>";
?>
