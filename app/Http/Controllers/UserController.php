<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $user = User::with(["posts"])->get();
        return ResponseFormatter::success($user, "Data berhasil di ambil", 200);
    }

    public function show($id)
    {
        $user = User::with(["posts"])->find($id);
        return ResponseFormatter::success($user, "Data berhasil di ambil", 200);
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);
        $email          = $request->input('email');
        $password       = $request->input('password');
        $passwordHas    = Hash::make($password);

        User::create([
            'email'     => $email,
            'password'  => $passwordHas
        ]);
        return ResponseFormatter::success(null, "Data $request->email berhasil registrasi", 201);
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);
        $email      = $request->input('email');
        $password   = $request->input('password');

        $user = User::where('email', $email)->first();
        if (!$user) {
            return ResponseFormatter::error(null, "$request->email tersebut tidak ditemukan", 401);
        }

        $isValidPassword = Hash::check($password, $user->password);
        if (!$isValidPassword) {
            return ResponseFormatter::error(null, "$request->password tersebut tidak sesuai di data kami", 401);
        }

        $gererateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $gererateToken
        ]);

        return ResponseFormatter::success([
            "access_token" => $gererateToken,
            "header" => "Token",
            "user" => $user
        ], "Berhasil login", 200);
    }
}
