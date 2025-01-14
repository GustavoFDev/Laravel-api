<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* Pra consultar todos los usuarios */

    public function index()
    {
        $users = User::all();
        return $users;
    }

    /* Pra actualizar el estatus de la cuenta */

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_active = $request->is_active;
        $user->save();
        return response()->json(['message' => 'User status updated successfully']);
    }

    /* Para registrar nuevos usuarios */

    public function register(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'is_active' => true,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    /* Para loggearse */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user->is_active) {
            return response()->json(['message' => 'Your account has been disabled.'], 403);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }

        $token = $user->createToken($user->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }


    /* Pra cerrar sesion */

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.'
        ];
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
    
}
