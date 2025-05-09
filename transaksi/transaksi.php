    <?php include '../layouts/header.php'; ?>
    <?php include '../config/koneksi.php'; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_qty'])) {
        $id = $_POST['id'];
        $qty = $_POST['qty'];

        if ($id && $qty > 0) {
            mysqli_query($koneksi, "UPDATE keranjang SET qty = $qty WHERE id = $id");
        }

        // Redirect untuk mencegah re-submit form saat refresh
        header('Location: transaksi.php');
        exit;
    }
    ?>

    <?php
    // Ambil isi keranjang
    $keranjang = mysqli_query($koneksi, "SELECT k.*, p.nama, p.harga FROM keranjang k JOIN produk p ON k.produk_id = p.id WHERE k.user_id = 1");
    $no = 1;
    $totalSemua = 0;
    ?>

    <!-- Sidebar -->
    <?php include '../layouts/sidebar.php'; ?>

    <!-- Konten utama -->
    <div class="p-4 sm:ml-64">
        <div class="flex-1 pt-4">
            <div class="pt-6 max-w-7xl mx-auto">
                <h2 class="text-xl font-semibold text-gray-700">Keranjang Penjualan</h2>

                <!-- Cari dan Hasil Pencarian -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <!-- Cari Barang -->
                    <div class="rounded shadow overflow-hidden">
                        <div class="bg-blue-600 text-white px-4 py-2 font-semibold flex items-center">
                            <span class="mr-2">🔍</span> Cari Barang
                        </div>
                        <div class="bg-white p-4">
                            <input type="text" id="inputCariBarang" class="w-full border p-2 rounded text-sm" placeholder="Masukkan kode atau nama barang" />
                        </div>
                    </div>
                    <!-- Hasil Pencarian -->
                    <div class="rounded shadow overflow-hidden">
                    <div class="bg-blue-600 text-white px-4 py-2 font-semibold flex items-center">
                        <span class="mr-2">📋</span> Hasil Pencarian
                    </div>
                    <div class="bg-white p-4">
                        <table class="w-full text-sm text-left border text-gray-700">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-2 py-1">ID</th>
                                    <th class="px-2 py-1">Nama</th>
                                    <th class="px-2 py-1">Harga</th>
                                    <th class="px-2 py-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelHasilPencarian">
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>         
            </div>
            <!-- Tabel Kasir -->
            <div class="mt-6 bg-white rounded shadow border">
                <div class="flex items-center justify-between bg-blue-600 text-white px-4 py-2 rounded-t">
                    <h3 class="font-semibold">🛒 KASIR</h3>
                    <form action="reset_keranjang.php" method="POST">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-semibold">RESET KERANJANG</button>
                    </form>
                </div>
                <div class="p-4">
                    <label class="text-sm font-medium text-gray-700 block mb-2">Tanggal</label>
                    <input type="text" value="<?= date('d F Y, H:i'); ?>" class="w-full px-3 py-2 border rounded bg-gray-100" readonly />

                    <!-- Table -->
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full table-auto border text-sm text-center">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-2 py-2">No</th>
                                    <th class="px-2 py-2">Nama Barang</th>
                                    <th class="px-2 py-2">Jumlah</th>
                                    <th class="px-2 py-2">Total</th>
                                    <th class="px-2 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $totalSemua = 0;
                                $keranjang = mysqli_query($koneksi, "SELECT keranjang.id, produk.nama, produk.harga, keranjang.qty FROM keranjang JOIN produk ON keranjang.produk_id = produk.id");

                                while ($item = mysqli_fetch_assoc($keranjang)) :
                                    $subtotal = $item['qty'] * $item['harga'];
                                    $totalSemua += $subtotal;
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['nama'] ?></td>
                                        <td>
                                            <form method="POST" action="">
                                                <input type="hidden" name="update_qty" value="1">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <input
                                                    type="number"
                                                    name="qty"
                                                    value="<?= $item['qty'] ?>"
                                                    min="1"
                                                    class="w-16 p-1 border rounded text-sm"
                                                    onchange="this.form.submit()" />
                                            </form>
                                        </td>
                                        <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                                        <td>
                                            <form action="hapus_item.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button class="text-red-500 hover:underline text-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                                <?php if ($no === 1) : ?>
                                    <tr>
                                        <td colspan="5" class="py-4 text-gray-500">Keranjang kosong</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Total dan Bayar -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div>
                            <label class="text-sm">Total Semua</label>
                            <input type="text" value="Rp<?= number_format($totalSemua, 0, ',', '.') ?>" class="w-full px-3 py-2 border rounded bg-gray-100" readonly />
                        </div>
                        <div>
                            <label class="text-sm">Bayar</label>
                            <input type="number" id="bayar" class="w-full px-3 py-2 border rounded" placeholder="Masukan uang bayar" required />
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm">Kembali</label>
                            <input type="text" id="kembali" class="w-full px-3 py-2 border rounded bg-gray-100" readonly />
                        </div>
                    </div>

                    <!-- Tombol Bayar dan Print -->
                    <div class="mt-6 flex justify-end items-center gap-3">
                        <form action="checkout.php" method="POST">
                            <input type="hidden" name="bayar" id="inputBayar" />
                            <button type="submit" onclick="document.getElementById('inputBayar').value = document.getElementById('bayar').value" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">💸 Bayar & Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../layouts/footer.php'; ?>

    <script>
        document.getElementById('inputCariBarang').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                let keyword = this.value;
                fetch('hasil_pencarian.php?cari=' + keyword)
                    .then(res => res.text())
                    .then(data => {
                        document.getElementById('tabelHasilPencarian').innerHTML = data;
                    });
            }
        });


        const bayarInput = document.getElementById('bayar');
        const kembaliInput = document.getElementById('kembali');

        bayarInput.addEventListener('input', function() {
            const bayar = parseInt(this.value);
            const total = <?= $totalSemua ?>;
            if (!isNaN(bayar) && bayar >= total) {
                kembaliInput.value = 'Rp' + (bayar - total).toLocaleString('id-ID');
            } else {
                kembaliInput.value = '';
            }
        });

        fetch('hasil_pencarian.php?cari=' + keyword)
            .then(res => res.text())
            .then(data => {
                document.getElementById('tabelHasilPencarian').innerHTML = data;
            });
    </script>