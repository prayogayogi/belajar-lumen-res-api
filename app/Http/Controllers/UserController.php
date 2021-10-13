<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordHas = Hash::make($password);

        User::create([
            'email' => $email,
            'password' => $passwordHas
        ]);
        return response()->json(['message' => 'Success'], 201);
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'login failed'], 401);
        }
        $isValidPassword = Hash::check($password, $user->password);
        if (!$isValidPassword) {
            return response()->json(['message' => 'login failed'], 401);
        }
        $gererateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $gererateToken
        ]);

        return response()->json($user);
    }
}
