<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FieldApiController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// --- API UNTUK LOGIN (Mendapatkan Token) ---
Route::post('/login', function (Request $request) {
    $request->validate(['email' => 'required|email', 'password' => 'required']);
    
    $user = User::where('email', $request->email)->first();
    
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email atau Password salah'], 401);
    }

    // Membuat Token Sanctum
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login Sukses',
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

// --- API CRUD LAPANGAN (Digembok oleh Sanctum) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Rute untuk mengecek profile user yang sedang login
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // Rute CRUD Field (Hanya bisa diakses kalau punya token)
    Route::apiResource('fields', FieldApiController::class);
    
});