<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    // Menampilkan semua barang
    public function index()
    {
        return response()->json(Barang::all(), 200);
    }

    // Menambahkan barang
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaGambar = null;

        // Jika ada gambar yang dipilih
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');

            $namaGambar = time() . '_' . $gambar->getClientOriginalName();

            $gambar->move(
                public_path('images'),
                $namaGambar
            );
        }

        $barang = Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $namaGambar,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => $barang
        ], 201);
    }

    // Menampilkan satu barang
    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return response()->json($barang, 200);
    }

    // Mengupdate barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Data yang akan diupdate
        $data = [
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ];

        // Jika memilih gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if (
                $barang->gambar &&
                File::exists(public_path('images/' . $barang->gambar))
            ) {
                File::delete(
                    public_path('images/' . $barang->gambar)
                );
            }

            $gambar = $request->file('gambar');

            $namaGambar = time() . '_' . $gambar->getClientOriginalName();

            $gambar->move(
                public_path('images'),
                $namaGambar
            );

            $data['gambar'] = $namaGambar;
        }

        $barang->update($data);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => $barang
        ], 200);
    }

    // Menghapus barang
    // Menghapus barang
public function destroy($id)
{
    try {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        // Simpan nama gambar terlebih dahulu
        $namaGambar = $barang->gambar;

        // Hapus data barang dari database TERLEBIH DAHULU
        $barang->delete();

        // Hanya hapus file gambar setelah data berhasil dihapus
        // Gambar lama dengan path "images/..." jangan dihapus
        if (
            $namaGambar &&
            !str_starts_with($namaGambar, 'images/') &&
            !str_starts_with($namaGambar, '/images/')
        ) {
            $pathGambar = public_path('images/' . $namaGambar);

            if (file_exists($pathGambar)) {
                unlink($pathGambar);
            }
        }

        return response()->json([
            'message' => 'Barang berhasil dihapus'
        ], 200);

    } catch (\Illuminate\Database\QueryException $e) {

        return response()->json([
            'message' => 'Produk tidak dapat dihapus karena sudah digunakan dalam transaksi.'
        ], 409);
    }
}
}