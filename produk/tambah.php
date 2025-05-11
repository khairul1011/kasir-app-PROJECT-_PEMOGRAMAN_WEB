<?php
include '../config/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($koneksi, "INSERT INTO produk (nama, kategori, harga, stok, deskripsi) VALUES ('$nama', '$kategori', '$harga', '$stok', '$deskripsi')");
    header("Location: list.php");
}
?>
