<?php

namespace App\Http\Controllers;

// use App\Models\Produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Produk::find($id);
        return response()->json($data);
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

        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (is_null($produk)) {
            abort(404);
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
        return response()->json($produk);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (is_null($produk)) {
            abort(404);
        }

        $produk->delete();
        return response()->json(['message' => 'Produk Deleted!']);
    }
}
