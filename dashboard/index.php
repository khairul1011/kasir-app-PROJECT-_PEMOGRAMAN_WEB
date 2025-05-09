<?php include '../layouts/header.php'; ?>
<?php include '../config/koneksi.php'; ?>
<?php include '../layouts/sidebar.php'; ?>
<main>
    <div class="p-4 sm:ml-64">
        <div class="flex-1 ">
            <div class="pt-6 max-w-7xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">Dashboard Kasir</h1>
                <!-- Shortcut Report -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-indigo-100 p-6 rounded-2xl">
                        <div class="text-indigo-800 text-2xl font-semibold">Rp24.575</div>
                        <div class="text-gray-600">Saldo Awal</div>
                        <div class="text-xs mt-2 text-indigo-600">+65%</div>
                    </div>
                    <div class="bg-amber-100 p-6 rounded-2xl">
                        <div class="text-amber-800 text-2xl font-semibold">Rp5.786</div>
                        <div class="text-gray-600">Transaksi Hari Ini</div>
                        <div class="text-xs mt-2 text-amber-600">+3.47%</div>
                    </div>
                    <div class="bg-rose-100 p-6 rounded-2xl">
                        <div class="text-rose-800 text-2xl font-semibold">Rp57.575</div>
                        <div class="text-gray-600">Pengeluaran Hari Ini</div>
                        <div class="text-xs mt-2 text-rose-600">-2.8%</div>
                    </div>
                    <div class="bg-green-100 p-6 rounded-2xl">
                        <div class="text-green-800 text-2xl font-semibold">Rp24.575</div>
                        <div class="text-gray-600">Pendapatan Bersih Hari Ini</div>
                        <div class="text-xs mt-2 text-green-600">+65%</div>
                    </div>
                </div>
                <!-- Navigasi Fitur -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    <a href="../transaksi/transaksi.php" class="bg-white p-6 rounded-2xl shadow hover:bg-blue-50 transition">
                        <h2 class="text-xl font-bold mb-2">Transaksi</h2>
                        <p>Mulai pencatatan penjualan</p>
                    </a>
                    <a href="../produk/list.php" class="bg-white p-6 rounded-2xl shadow hover:bg-blue-50 transition">
                        <h2 class="text-xl font-bold mb-2">Produk</h2>
                        <p>Kelola stok barang</p>
                    </a>
                    <a href="../pelanggan/list.php" class="bg-white p-6 rounded-2xl shadow hover:bg-blue-50 transition">
                        <h2 class="text-xl font-bold mb-2">Pelanggan</h2>
                        <p>Lihat data pelanggan</p>
                    </a>
                </div>
                <!-- Cashflow Chart -->
                <div class="bg-white p-6 rounded-2xl shadow" style="height: 300px;">
                    <h2 class="text-xl font-bold mb-4">Arus Kas</h2>
                    <canvas id="cashflowChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('cashflowChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                    label: 'Pengeluaran',
                    data: [120, 140, 160, 140, 180, 165, 195],
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Pendapatan',
                    data: [100, 120, 140, 160, 180, 200, 220],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
<?php include '../layouts/sidebar.php'; ?>