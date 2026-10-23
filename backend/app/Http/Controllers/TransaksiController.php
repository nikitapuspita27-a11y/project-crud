<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function index()
{
    $transaksi = Transaksi::latest()->get();
    return response()->json($transaksi);
}

public function show($id)
{
    $transaksi = Transaksi::with('detailTransaksi')->findOrFail($id);

    return response()->json([
        'id' => $transaksi->id,
        'no_nota' => $transaksi->no_nota,
        'tanggal' => $transaksi->created_at->format('d/m/Y H:i'),
        'metode' => $transaksi->metode_pembayaran,
        'total' => $transaksi->total_harga,
        'bayar' => $transaksi->bayar,
        'kembali' => $transaksi->kembali,
        'items' => $transaksi->detailTransaksi
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'bayar' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {

            $totalHarga = 0;

            // Cek stok dan hitung total
            foreach ($request->items as $item) {

                $barang = Barang::findOrFail($item['id']);

                if ($barang->stok < $item['qty']) {
                    return response()->json([
                        'message' => "Stok {$barang->nama_barang} tidak mencukupi"
                    ], 400);
                }

                $totalHarga += $barang->harga * $item['qty'];
            }

            // Khusus pembayaran Tunai
            if ($request->metode_pembayaran == "Tunai") {

                if ($request->bayar < $totalHarga) {
                    return response()->json([
                        'message' => 'Uang yang dibayarkan kurang.'
                    ], 400);
                }

                $bayar = $request->bayar;
                $kembali = $bayar - $totalHarga;

            } else {

                // QRIS, Transfer, Debit
                $bayar = $totalHarga;
                $kembali = 0;
            }

            // Kurangi stok
            foreach ($request->items as $item) {

                $barang = Barang::findOrFail($item['id']);
                $barang->decrement('stok', $item['qty']);

            }

           // Simpan transaksi
$transaksi = Transaksi::create([
    'no_nota' => 'TRX' . time(),
    'total_harga' => $totalHarga,
    'bayar' => $bayar,
    'kembali' => $kembali,
    'metode_pembayaran' => $request->metode_pembayaran,
]);

foreach ($request->items as $item) {

    $barang = Barang::findOrFail($item['id']);

    DetailTransaksi::create([
        'transaksi_id' => $transaksi->id,
        'barang_id' => $barang->id,
        'nama_barang' => $barang->nama_barang,
        'harga' => $barang->harga,
        'qty' => $item['qty'],
        'subtotal' => $barang->harga * $item['qty'],
    ]);

}

return response()->json([
    'message' => 'Transaksi berhasil',
    'transaksi' => [
        'id' => $transaksi->id,
        'no_nota' => $transaksi->no_nota,
        'tanggal' => $transaksi->created_at->format('d/m/Y H:i'),
        'total' => $transaksi->total_harga,
        'bayar' => $transaksi->bayar,
        'kembali' => $transaksi->kembali,
        'metode' => $transaksi->metode_pembayaran,
        'items' => DetailTransaksi::where(
            'transaksi_id',
            $transaksi->id
        )->get()
    ]
],201);
        });
    }
}