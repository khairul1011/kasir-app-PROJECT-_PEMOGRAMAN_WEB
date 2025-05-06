<?php
include '../config/koneksi.php';

$keyword = $_GET['keyword'] ?? '';
$result = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama LIKE '%$keyword%' OR id = '$keyword' LIMIT 5");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='border p-2 mb-1 cursor-pointer hover:bg-blue-100' onclick='tambahKeKeranjang({$row['id']})'>
            {$row['nama']} - Rp " . number_format($row['harga']) . "
          </div>";
}
?>
