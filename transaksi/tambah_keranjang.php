<?php
include '../config/koneksi.php';

$produk_id = $_POST['produk_id'];
$qty = $_POST['qty'];

// Validasi input
if ($produk_id && $qty > 0) {
    $query = "INSERT INTO keranjang (user_id, produk_id, qty) VALUES (1, '$produk_id', '$qty')";
    mysqli_query($koneksi, $query);
}

$cari = $_GET['cari'] ?? '';
$hasil = [];

if ($cari) {
    $stmt = $koneksi->prepare("SELECT * FROM produk WHERE nama LIKE ? OR id = ?");
    $like = "%" . $cari . "%";
    $stmt->bind_param("ss", $like, $cari);
    $stmt->execute();
    $hasil = $stmt->get_result();
}
    
    else {
        $stmt = $koneksi->prepare("SELECT * FROM produk");
        $stmt->execute();
        $hasil = $stmt->get_result();
    }
$stmt->close();
$koneksi->close();

header("Location: transaksi.php");
exit;
