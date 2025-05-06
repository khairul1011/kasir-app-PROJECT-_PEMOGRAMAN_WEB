<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT * FROM transaksi WHERE id = $id"));
$detail = mysqli_query($koneksi, 
    "SELECT dt.*, p.nama, p.harga 
     FROM detail_transaksi dt 
     JOIN produk p ON dt.produk_id = p.id 
     WHERE dt.transaksi_id = $id");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan</title>
    <style>
        body { font-family: monospace; }
        .struk { width: 300px; margin: 20px auto; }
        .text-center { text-align: center; }
        .border-top { border-top: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 4px 0; }
    </style>
</head>
<body onload="cetakDanKembali()">
    <div class="struk">
        <div class="text-center">
            <h3>KASIR APP</h3>
            <p><?= date("d/m/Y H:i", strtotime($transaksi['created_at'])) ?></p>
            <p>Kode: <?= $transaksi['kode_transaksi'] ?></p>
        </div>
        <div class="border-top"></div>
        <table>
            <?php while ($item = mysqli_fetch_assoc($detail)) : ?>
                <tr>
                    <td colspan="2"><?= $item['nama'] ?></td>
                </tr>
                <tr>
                    <td><?= $item['qty'] ?> x Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td style="text-align: right;">Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div class="border-top"></div>
        <p>Total: <strong>Rp<?= number_format($transaksi['total'], 0, ',', '.') ?></strong></p>
        <p>Pembayaran: <?= $transaksi['metode_pembayaran'] ?></p>
        <div class="border-top"></div>
        <div class="text-center">
            <p>~ Terima Kasih ~</p>
        </div>
    </div>
    <script>
function cetakDanKembali() {
    window.print();
    setTimeout(() => {
        window.location.href = 'transaksi.php';
    }, 1500);
}
</script>
</body>
</html>
