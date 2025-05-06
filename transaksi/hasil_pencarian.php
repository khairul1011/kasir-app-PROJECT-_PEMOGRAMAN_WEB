<?php
include '../config/koneksi.php';

$cari = $_GET['cari'] ?? '';

if ($cari) {
    $stmt = $koneksi->prepare("SELECT * FROM produk WHERE nama LIKE ? OR id = ?");
    $like = "%" . $cari . "%";
    $stmt->bind_param("ss", $like, $cari);
} else {
    $stmt = $koneksi->prepare("SELECT * FROM produk");
}

$stmt->execute();
$hasil = $stmt->get_result();

if ($hasil->num_rows > 0) {
    while ($row = $hasil->fetch_assoc()) {
        echo "<tr>
                <td class='px-2 py-1'>" . htmlspecialchars($row['id']) . "</td>
                <td class='px-2 py-1'>" . htmlspecialchars($row['nama']) . "</td>
                <td class='px-2 py-1'>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                <td class='px-2 py-1'>
                    <form method='POST' action='tambah_keranjang.php' class='inline'>
                        <input type='hidden' name='produk_id' value='" . htmlspecialchars($row['id']) . "'>
                        <input type='hidden' name='qty' value='1'>
                        <button type='submit' class='bg-blue-500 hover:bg-blue-600 text-white text-sm px-2 py-1 rounded'>+ Tambah</button>
                    </form>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center text-gray-500 py-2'>Produk tidak ditemukan.</td></tr>";
}

$stmt->close();
?>
