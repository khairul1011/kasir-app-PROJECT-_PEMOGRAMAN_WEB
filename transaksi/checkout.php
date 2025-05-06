<?php
include '../config/koneksi.php';

$user_id = 1; // sementara, bisa disesuaikan sesuai login
$bayar = isset($_POST['bayar']) ? (int)$_POST['bayar'] : 0;

// Ambil isi keranjang
$keranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE user_id = $user_id");

$total = 0;
$items = [];

while ($item = mysqli_fetch_assoc($keranjang)) {
    $produk_id = $item['produk_id'];
    $qty = $item['qty'];

    // Ambil harga produk
    $produk = mysqli_query($koneksi, "SELECT harga, stok FROM produk WHERE id = $produk_id");
    $produkData = mysqli_fetch_assoc($produk);

    $harga = $produkData['harga'];
    $stok = $produkData['stok'];

    // Validasi stok
    if ($qty > $stok) {
        echo "Stok tidak mencukupi untuk produk ID: $produk_id";
        exit;
    }

    $subtotal = $harga * $qty;
    $total += $subtotal;
    $items[] = compact('produk_id', 'qty', 'subtotal');
}

// Validasi pembayaran
if ($bayar < $total) {
    echo "Pembayaran tidak mencukupi. Total: Rp" . number_format($total, 0, ',', '.') . ", Bayar: Rp" . number_format($bayar, 0, ',', '.');
    exit;
}

// Simpan transaksi
$kode_transaksi = "TRX" . time();
$metode = 'Tunai'; // atau ambil dari input jika disediakan
$pelanggan_id = NULL;

mysqli_query($koneksi, "INSERT INTO transaksi (kode_transaksi, user_id, pelanggan_id, total, metode_pembayaran) 
VALUES ('$kode_transaksi', $user_id, NULL, $total, '$metode')");

$transaksi_id = mysqli_insert_id($koneksi);

// Simpan detail transaksi & update stok
foreach ($items as $i) {
    $produk_id = $i['produk_id'];
    $qty = $i['qty'];
    $subtotal = $i['subtotal'];

    mysqli_query($koneksi, "INSERT INTO detail_transaksi (transaksi_id, produk_id, qty, subtotal) 
                            VALUES ($transaksi_id, $produk_id, $qty, $subtotal)");

    mysqli_query($koneksi, "UPDATE produk SET stok = stok - $qty WHERE id = $produk_id");
}

// Kosongkan keranjang
mysqli_query($koneksi, "DELETE FROM keranjang WHERE user_id = $user_id");

// Redirect ke halaman cetak struk
header("Location: cetak_struk.php?id=$transaksi_id");
exit;
?>
