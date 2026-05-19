<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Peminjaman Alat Lab') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- 1. BARIS STATISTIK (CARDS) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Card: Total Alat -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Alat Lab</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">142</h3>
                    </div>
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                </div>

                <!-- Card: Sedang Dipinjam -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sedang Dipinjam</p>
                        <h3 class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-1">18</h3>
                    </div>
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

                <!-- Card: Menunggu Persetujuan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Approval</p>
                        <h3 class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">5</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

                <!-- Card: Terlambat -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Terlambat Kembali</p>
                        <h3 class="text-2xl font-bold text-red-600 dark:text-red-400 mt-1">2</h3>
                    </div>
                    <div class="p-3 bg-red-50 dark:bg-red-900/30 rounded-lg text-red-600 dark:text-red-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                </div>
            </div>

            <!-- 2. AREA AKSI UTAMA & TABEL -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <!-- Header Tabel -->
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Peminjaman Terbaru</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Daftar transaksi pengajuan dan peminjaman alat laboratorium terkini.</p>
                    </div>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 active:bg-blue-800 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Buat Peminjaman
                    </a>
                </div>

                <!-- Struktur Tabel Standar -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                                <th class="px-6 py-4">Peminjam</th>
                                <th class="px-6 py-4">Alat Lab</th>
                                <th class="px-6 py-4">Tanggal Pinjam</th>
                                <th class="px-6 py-4">Batas Kembali</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
                            <!-- Row 1: Sedang Dipinjam -->
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">Aris Setiawan</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">NIM. 2201492</div>
                                </td>
                                <td class="px-6 py-4">Mikroskop Binokuler Olympus CX23</td>
                                <td class="px-6 py-4">18 Mei 2026</td>
                                <td class="px-6 py-4">22 Mei 2026</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span>Dipinjam
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Detail</a>
                                </td>
                            </tr>

                            <!-- Row 2: Selesai / Kembali -->
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">Citra Lestari</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">NIM. 2201311</div>
                                </td>
                                <td class="px-6 py-4">Digital Multimeter Sanwa CD800a</td>
                                <td class="px-6 py-4">15 Mei 2026</td>
                                <td class="px-6 py-4">17 Mei 2026</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span>Kembali
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Detail</a>
                                </td>
                            </tr>

                            <!-- Row 3: Terlambat -->
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">Dimas Prabowo</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">NIM. 2201105</div>
                                </td>
                                <td class="px-6 py-4">Spektrofotometer UV-Vis</td>
                                <td class="px-6 py-4">10 Mei 2026</td>
                                <td class="px-6 py-4 class="text-red-600 dark:text-red-400 font-medium"">15 Mei 2026</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>Terlambat
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Footer Tabel / Pagination (Simulasi) -->
                <div class="p-4 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400 text-right">
                    Menampilkan 3 dari 18 transaksi aktif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>