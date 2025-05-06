<?php
include '../config/koneksi.php';

// ID user sementara hardcoded = 1
$user_id = 1;

// Hapus semua isi keranjang milik user tersebut
$query = "DELETE FROM keranjang WHERE user_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// Redirect kembali ke halaman transaksi
header("Location: ../transaksi/transaksi.php");
exit;
