<?php
include '../config/koneksi.php';
include '../layouts/header.php';
include '../layouts/sidebar.php';

$data = mysqli_query($koneksi, "SELECT * FROM produk");
?>
<main class="pt-10">
    <div class="p-4">
        <div class="p-auto">
            <div class="p-4 max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex gap-2">
                        <!-- <a href="tambah.php" class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded transition">
                            <span>➕</span> Tambah Produk
                        </a> -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded transition" type="button">
                            Tambah Produk ➕
                        </button>
                        <button class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded transition">📥 Import</button>
                    </div>
                    <div class="flex gap-2">
                        <button class="flex items-center gap-1 border border-purple-500 text-purple-600 px-3 py-2 rounded hover:bg-purple-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path fill="currentColor" d="M19 11a8 8 0 1 1-16 0a8 8 0 0 1 16 0" opacity="0.16" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21l-4.343-4.343m0 0A8 8 0 1 0 5.343 5.343a8 8 0 0 0 11.314 11.314" />
                                </g>
                            </svg>
                            Filter
                        </button>
                        <button class="flex items-center justify-center border border-orange-500 text-orange-500 px-3 py-2 rounded hover:bg-orange-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 15 15">
                                <path fill="currentColor" d="M2.5 6.5V6H2v.5zm4 0V6H6v.5zm0 4H6v.5h.5zm7-7h.5v-.207l-.146-.147zm-3-3l.354-.354L10.707 0H10.5zM2.5 7h1V6h-1zm.5 4V8.5H2V11zm0-2.5v-2H2v2zm.5-.5h-1v1h1zm.5-.5a.5.5 0 0 1-.5.5v1A1.5 1.5 0 0 0 5 7.5zM3.5 7a.5.5 0 0 1 .5.5h1A1.5 1.5 0 0 0 3.5 6zM6 6.5v4h1v-4zm.5 4.5h1v-1h-1zM9 9.5v-2H8v2zM7.5 6h-1v1h1zM9 7.5A1.5 1.5 0 0 0 7.5 6v1a.5.5 0 0 1 .5.5zM7.5 11A1.5 1.5 0 0 0 9 9.5H8a.5.5 0 0 1-.5.5zM10 6v5h1V6zm.5 1H13V6h-2.5zm0 2H12V8h-1.5zM2 5V1.5H1V5zm11-1.5V5h1V3.5zM2.5 1h8V0h-8zm7.646-.146l3 3l.708-.708l-3-3zM2 1.5a.5.5 0 0 1 .5-.5V0A1.5 1.5 0 0 0 1 1.5zM1 12v1.5h1V12zm1.5 3h10v-1h-10zM14 13.5V12h-1v1.5zM12.5 15a1.5 1.5 0 0 0 1.5-1.5h-1a.5.5 0 0 1-.5.5zM1 13.5A1.5 1.5 0 0 0 2.5 15v-1a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            PDF
                        </button>
                        <button onclick="exportExcel()"
                            class="flex items-center justify-center border border-green-500 text-green-500 px-3 py-2 rounded hover:bg-green-50 transition">
                            <!-- ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 48 48">
                                <defs>
                                    <mask id="ipSExcel0">
                                        <g fill="none" stroke-linecap="round" stroke-width="4">
                                            <path stroke="#fff" stroke-linejoin="round" d="M8 15V6a2 2 0 0 1 2-2h28a2 2 0 0 1 2 2v36a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-9" />
                                            <path stroke="#fff" d="M31 15h3m-6 8h6m-6 8h6" />
                                            <path fill="#fff" stroke="#fff" stroke-linejoin="round" d="M4 15h18v18H4z" />
                                            <path stroke="#000" stroke-linejoin="round" d="m10 21l6 6m0-6l-6 6" />
                                        </g>
                                    </mask>
                                </defs>
                                <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipSExcel0)" />
                            </svg>
                            &nbsp;Excel
                        </button>

                        <button onclick="window.open('print.php', '_blank')"
                            class="flex items-center justify-center border border-blue-500 text-blue-500 px-3 py-2 rounded hover:bg-blue-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M8 21q-.825 0-1.412-.587T6 19v-2H4q-.825 0-1.412-.587T2 15v-4q0-1.275.875-2.137T5 8h14q1.275 0 2.138.863T22 11v4q0 .825-.587 1.413T20 17h-2v2q0 .825-.587 1.413T16 21zm-4-6h2q0-.825.588-1.412T8 13h8q.825 0 1.413.588T18 15h2v-4q0-.425-.288-.712T19 10H5q-.425 0-.712.288T4 11zm12-7V5H8v3H6V5q0-.825.588-1.412T8 3h8q.825 0 1.413.588T18 5v3zm2 4.5q.425 0 .713-.288T19 11.5t-.288-.712T18 10.5t-.712.288T17 11.5t.288.713t.712.287M16 19v-4H8v4zM4 10h16z" />
                            </svg>
                            &nbsp;Print
                        </button>

                    </div>
                </div>
                <input type="text" placeholder="Cari Produk..." class="w-full p-2 border border-gray-300 rounded mb-4" />
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 bg-white shadow rounded-lg">
                        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-3"><input type="checkbox" /></th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Harga</th>
                                <th class="px-4 py-3">Stok</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-3"><input type="checkbox" /></td>
                                    <!-- <td class="px-4 py-3">
                                        <?php if (!empty($row['gambar'])): ?>
                                            <img src="../uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Gambar Produk" class="w-12 h-12 object-cover rounded" />
                                        <?php else: ?>
                                            <span class="text-gray-400 italic">Tidak ada gambar</span>
                                        <?php endif; ?>
                                    </td> -->
                                    <td class="px-4 py-3"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($row['kategori']) ?></td>
                                    <td class="px-4 py-3">Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-3"><?= $row['stok'] ?></td>
                                    <td class="px-4 py-3">
                                        <div class="relative inline-block text-left">
                                            <button onclick="toggleDropdown(this)" class="text-blue-600 font-semibold hover:underline">Action ⬇</button>
                                            <div class="hidden absolute z-10 mt-2 w-28 bg-white border rounded shadow-md">
                                                <a href="edit.php?id=<?= $row['id'] ?>" class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                                                <a href="hapus.php?id=<?= $row['id'] ?>" class="block px-4 py-2 hover:bg-gray-100 text-red-500" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Produk Baru
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="tambah.php" method="POST">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nama Produk" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                            <input type="number" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Rp10.000" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" require>
                                <option selected="">Pilih Kategori</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kuantiti:</label>
                            <div class="relative flex items-center max-w-[8rem]">
                                <button type="button" id="decrement-button" data-input-counter-decrement="stok" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="stok" name="stok" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="1" placeholder="1" required />
                                <button type="button" id="increment-button" data-input-counter-increment="stok" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Please select a 5 digit number from 0 to 9.</p>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                            <textarea id="description" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tulis deskripsi produk"></textarea>
                        </div>

                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Tambah Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    function toggleDropdown(button) {
        const menu = button.nextElementSibling;
        menu.classList.toggle('hidden');
        document.addEventListener('click', function(e) {
            if (!button.parentElement.contains(e.target)) {
                menu.classList.add('hidden');
            }
        }, {
            once: true
        });
    }

    function exportExcel() {
        window.open("export_excel.php", "_blank");
    }
</script>
<?php include '../layouts/footer.php'; ?>