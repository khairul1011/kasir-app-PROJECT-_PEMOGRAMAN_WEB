<?php
include '../config/koneksi.php'; // Sesuaikan path jika berbeda
include '../layouts/header.php';


$search_keyword = $_GET['search_keyword'] ?? '';
$kategori_filter = $_GET['kategori'] ?? '';

$query = "SELECT * FROM produk WHERE 1=1";

if (!empty($search_keyword)) {
    $query .= " AND (nama LIKE '%" . mysqli_real_escape_string($koneksi, $search_keyword) . "%' OR deskripsi LIKE '%" . mysqli_real_escape_string($koneksi, $search_keyword) . "%')";
}

if (!empty($kategori_filter) && $kategori_filter !== 'Semua Kategori') {
    $query .= " AND kategori = '" . mysqli_real_escape_string($koneksi, $kategori_filter) . "'";
}

$data = mysqli_query($koneksi, $query);

if (mysqli_num_rows($data) > 0) {
    while ($row = mysqli_fetch_assoc($data)) {
        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">';
        echo '<td class="w-4 p-4"><div class="flex items-center"><input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></div></td>';
        echo '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' . htmlspecialchars($row['nama']) . '</th>';
        echo '<td class="px-6 py-4">' . htmlspecialchars($row['kategori']) . '</td>';
        echo '<td class="px-6 py-4">Rp' . number_format($row['harga'], 0, ',', '.') . '</td>';
        echo '<td class="px-6 py-4">' . $row['stok'] . '</td>';
        echo '<td class="flex items-center px-6 py-4">';
        echo '<a href="edit.php?id=' . $row['id'] . '" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>';
        echo '<a href="hapus.php?id=' . $row['id'] . '" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada produk ditemukan.</td></tr>';
}
?>