@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-10 border shadow-sm print:border-none print:shadow-none print:p-0">
    
    <div class="text-center border-b-2 border-black pb-5 mb-8">
        <h1 class="text-2xl font-bold uppercase tracking-widest">JerseyHolic Official Store</h1>
        <p class="text-sm">Laporan Penjualan Produk Bulanan</p>
        <p class="text-xs uppercase">Periode: {{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $year }}</p>
    </div>

    <div class="print:hidden mb-6 flex gap-2">
        <form action="{{ route('reports.index') }}" method="GET" class="flex gap-2">
            <select name="month" class="border p-2 rounded text-sm">
                @for($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                @endfor
            </select>
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">Tampilkan</button>
        </form>
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Cetak PDF</button>
    </div>

    <table class="w-full border-collapse border border-black">
        <thead>
            <tr class="bg-gray-50">
                <th class="border border-black p-3 text-left text-sm uppercase">Nama Produk / Jersey</th>
                <th class="border border-black p-3 text-center text-sm uppercase w-24">Terjual</th>
                <th class="border border-black p-3 text-right text-sm uppercase w-48">Subtotal Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salesData as $data)
            <tr>
                <td class="border border-black p-3 text-sm">
                    {{ $data->product->team_name ?? 'Produk Tidak Diketahui' }}
                </td>
                <td class="border border-black p-3 text-center text-sm">
                    {{ $data->total_qty }} Pcs
                </td>
                <td class="border border-black p-3 text-right text-sm">
                    Rp {{ number_format($data->total_revenue, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="border border-black p-10 text-center text-gray-500 italic text-sm">
                    Tidak ada transaksi pada periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="font-bold bg-gray-100">
                <td class="border border-black p-3 text-sm uppercase text-right">TOTAL KESELURUHAN</td>
                <td class="border border-black p-3 text-center text-sm">{{ $grandTotalQty }} Pcs</td>
                <td class="border border-black p-3 text-right text-sm">Rp {{ number_format($grandTotalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="hidden print:block mt-12">
        <div class="flex justify-between">
            <div class="text-center">
                <p class="text-sm">Disetujui Oleh,</p>
                <div class="h-20"></div>
                <p class="text-sm font-bold border-t border-black pt-1">( Dosen Penguji )</p>
            </div>
            <div class="text-center">
                <p class="text-sm">Bandung, {{ date('d M Y') }}</p>
                <p class="text-sm">Admin Toko,</p>
                <div class="h-20"></div>
                <p class="text-sm font-bold border-t border-black pt-1">( {{ Auth::user()->name }} )</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    @page { margin: 2cm; }
    body { background: white !important; }
    nav, aside, header, footer, .sidebar { display: none !important; }
    .max-w-4xl { border: none !important; width: 100% !important; max-width: 100% !important; }
}
</style>
@endsection
