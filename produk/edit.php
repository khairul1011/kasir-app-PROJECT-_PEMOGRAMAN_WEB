<?php
include '../config/koneksi.php';
include '../layouts/header.php';

$id = $_GET['id'];
$produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($koneksi, "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok' WHERE id=$id");
    header("Location: list.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-4">Edit Produk</h1>
<form method="POST" class="max-w-md space-y-4">
    <input name="nama" value="<?= $produk['nama'] ?>" class="w-full p-2 border rounded" required />
    <input name="harga" type="number" value="<?= $produk['harga'] ?>" class="w-full p-2 border rounded" required />
    <input name="stok" type="number" value="<?= $produk['stok'] ?>" class="w-full p-2 border rounded" required />
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
</form>

<?php include '../layouts/footer.php'; ?>
