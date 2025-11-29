@extends('layouts.admin')

@section('title', 'Data Jersey')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Stok Jersey</h1>
        <p class="text-gray-600 text-sm">Kelola data jersey tim kesayangan Anda di sini.</p>
    </div>
    <!-- Tombol Tambah Data -->
    <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center gap-2 transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Tambah Jersey Baru
    </a>
</div>

<!-- Pesan Sukses (Akan muncul setelah Create/Update/Delete) -->
@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center" role="alert">
        <div>
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif

<!-- Tabel Data -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Info Produk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Musim</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $index => $product)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    <!-- Nomor Urut -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $loop->iteration }}
                    </td>
                    
                    <!-- Info Produk (Gambar & Nama) -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-lg font-bold shadow-sm">
                                <!-- Jika ada gambar (nanti), tampilkan gambar. Jika tidak, inisial nama tim -->
                                {{ substr($product->team_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-gray-900">{{ $product->team_name }}</div>
                                <div class="text-xs text-gray-500">Jersey Original</div>
                            </div>
                        </div>
                    </td>

                    <!-- Musim -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $product->season }}
                        </span>
                    </td>

                    <!-- Harga -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <!-- Stok (Dengan Logika Warna) -->
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($product->stock > 10)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                {{ $product->stock }} Unit
                            </span>
                        @elseif($product->stock > 0)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                {{ $product->stock }} Unit (Tipis)
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                Habis
                            </span>
                        @endif
                    </td>

                    <!-- Tombol Aksi -->
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-3">
                            <!-- Tombol Edit (Dummy Link dulu) -->
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            
                            <!-- Tombol Hapus (Dummy Form dulu) -->
                            <button class="text-red-600 hover:text-red-900 flex items-center gap-1 transition" onclick="alert('Fitur Hapus akan aktif di Tahap selanjutnya!')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <!-- Tampilan Jika Data Kosong -->
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-lg font-medium text-gray-900">Belum ada data jersey</p>
                            <p class="text-sm text-gray-500">Mulai dengan menambahkan data jersey pertama Anda.</p>
                            <a href="{{ route('products.create') }}" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium">
                                + Tambah Data Sekarang
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Bagian Footer Tabel (Pagination Placeholder) -->
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        <p class="text-xs text-gray-500">Menampilkan seluruh data stok yang tersedia.</p>
    </div>
</div>
@endsection