<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Get Data
    public function index()
    {
        $item = Post::all();
        return response([
            'success' => true,
            'message' => 'Data Behasil di Ambil',
            'data' => $item
        ], 200);
    }

    // Store
    public function store(Request $request)
    {
        $item = Post::create([
            'name'     => $request->input('name'),
            'deskripsi'   => $request->input('deskripsi')
        ]);


        if ($item) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 400);
        }
    }

    //
    public function show($id)
    {
        $item = Post::find($id);

        if ($item) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data',
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Not Found',
                'data' => ''
            ], 404);
        }
    }
}
