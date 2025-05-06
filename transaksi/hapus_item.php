<?php
include '../config/koneksi.php';

$id = $_POST['id'] ?? null;

if ($id && is_numeric($id)) {
    $stmt = $koneksi->prepare("DELETE FROM keranjang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: transaksi.php");
exit;
