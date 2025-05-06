<?php
include '../config/koneksi.php';
include '../layouts/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($koneksi, "INSERT INTO produk (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')");
    header("Location: list.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>
<form method="POST" class="max-w-md space-y-4">
    <input name="nama" placeholder="Nama Produk" required class="w-full p-2 border rounded" />
    <input type="number" name="harga" placeholder="Harga" required class="w-full p-2 border rounded" />
    <input type="number" name="stok" placeholder="Stok" required class="w-full p-2 border rounded" />
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php include '../layouts/footer.php'; ?>
