@extends('layouts.admin')

@section('title', 'Tambah Jersey Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Stok Jersey</h1>
        <p class="text-gray-600 text-sm">Masukkan detail jersey baru ke dalam inventaris.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6">
        
        <!-- Form Start -->
        <!-- enctype="multipart/form-data" WAJIB ada jika ada upload file/gambar -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token Keamanan Wajib -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Kolom Kiri -->
                <div class="space-y-6">
                    <!-- Nama Tim -->
                    <div>
                        <label for="team_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tim / Klub</label>
                        <input type="text" name="team_name" id="team_name" placeholder="Contoh: Manchester United" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    </div>

                    <!-- Musim -->
                    <div>
                        <label for="season" class="block text-sm font-medium text-gray-700 mb-1">Musim</label>
                        <input type="text" name="season" id="season" placeholder="Contoh: 2024/2025" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    </div>
                    
                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual (Rp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="price" id="price" placeholder="150000" required
                                class="w-full pl-10 rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-6">
                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok Awal</label>
                        <input type="number" name="stock" id="stock" placeholder="Jumlah barang tersedia" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    </div>

                    <!-- Upload Gambar -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Foto Jersey (Opsional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition cursor-pointer relative">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                        <span>Upload sebuah file</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-bold shadow-md hover:bg-indigo-700 transition transform hover:scale-105">
                    Simpan Jersey
                </button>
            </div>
        </form>
        <!-- Form End -->

    </div>
</div>
@endsection