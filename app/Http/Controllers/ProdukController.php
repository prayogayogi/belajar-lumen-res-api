<?php

namespace App\Http\Controllers;

// use App\Models\Produk;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = Produk::all();
        return ResponseFormatter::success($data, "Data Behasil di ambil.");
    }

    public function show($id)
    {
        $data = Produk::find($id);
        if (!$data) {
            return ResponseFormatter::error(null, "Data dengan ID $id tidak ada");
        }
        return ResponseFormatter::success($data, "Data dengan {$id} berhasil di ambil");
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required',
            'warna' => 'required',
            'kondisi' => 'required',
            'deskripsi' => 'required'
        ]);
        $data = $request->all();
        $produk = Produk::create($data);
        return ResponseFormatter::success($produk, "Data Produk $request->nama berhasil di tambah");
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (is_null($produk)) {
            return ResponseFormatter::error(null, "Data dengan ID $id tidak ada", 404);
        }
        $this->validate($request, [
            'nama' => 'string',
            'harga' => 'integer',
            'warna' => 'string',
            'kondisi' => 'in:baru,lama',
            'deskripsi' => 'string'
        ]);
        $data = $request->all();
        $produk->fill($data);

        $produk->save();
        return ResponseFormatter::success($produk, "Data Produk $request->nama Berhasil di update");
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (is_null($produk)) {
            return ResponseFormatter::error(null, "Data dengan ID $id tidak ada", 404);
        }

        $produk->delete();
        return ResponseFormatter::success($produk, "Data Produk $produk->nama Berhasil di hapus");
    }
}
