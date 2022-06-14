<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Get Data
    public function index()
    {
        $item = Post::with(["user"])->get();
        return ResponseFormatter::success($item, "Data Behasil di Ambil", 200);
    }

    // Store
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"      => "required|string",
            "deskripsi" => "required"
        ]);

        $item = Post::create($request->all());
        return ResponseFormatter::success($item, "Data Berhasil di Tambah", 200);
    }

    //
    public function show($id)
    {
        $item = Post::find($id);

        if (is_null($item)) {
            return ResponseFormatter::error(null, "Data post dengan id $id tidak ada", 401);
        }
        return ResponseFormatter::success($item, "Data berhasil di ambil", 200);
    }

    // Destroy
    public function destroy($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return ResponseFormatter::error(null, "Data dengan id $id tidak ada", 401);
        }
        return ResponseFormatter::success($post, "Data Post $post->name berhasil di hapus");
        $post->delete();
    }
}
