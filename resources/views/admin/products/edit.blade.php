@extends('layouts.admin')

@section('title', 'Edit Jersey')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Data Jersey</h1>
        <p class="text-gray-600 text-sm">Perbarui informasi stok atau harga jersey.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6">
        
        <!-- Form Update -->
        <!-- Perhatikan rute update menggunakan ID product dan method PUT -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Wajib untuk proses Update di Laravel -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Kolom Kiri -->
                <div class="space-y-6">
                    <!-- Nama Tim -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tim / Klub</label>
                        <input type="text" name="team_name" value="{{ old('team_name', $product->team_name) }}" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <!-- Musim -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Musim</label>
                        <input type="text" name="season" value="{{ old('season', $product->season) }}" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    
                    <!-- Harga -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga Jual (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-6">
                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                            class="w-full rounded-lg border-gray-300 border p-2.5 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Jersey (Opsional)</label>
                        
                        <!-- Preview gambar lama jika ada -->
                        @if($product->image)
                            <div class="mb-3 p-2 border rounded bg-gray-50 inline-block">
                                <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Foto Lama" class="h-24 w-auto object-cover rounded">
                            </div>
                        @endif
                        
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition"/>
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-bold shadow-md hover:bg-indigo-700 transition">Simpan Perubahan</button>
            </div>
        </form>

    </div>
</div>
@endsection