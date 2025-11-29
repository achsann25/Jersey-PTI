@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>

    <div class="grid grid-cols-3 gap-4">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
            <h3 class="text-gray-500">Total Jersey</h3>
            <p class="text-3xl font-bold">{{ $totalProducts }}</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded shadow border-l-4 border-yellow-500">
            <h3 class="text-gray-500">Stok Menipis</h3>
            <p class="text-3xl font-bold">{{ $stokTipis }}</p>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
            <h3 class="text-gray-500">Status Server</h3>
            <p class="text-lg font-bold text-green-600">Online</p>
        </div>
    </div>
@endsection