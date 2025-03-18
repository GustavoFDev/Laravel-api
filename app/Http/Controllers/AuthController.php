<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\password_reset_tokens;

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


    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(60);

        // Guarda o actualiza el token en la colección
        password_reset_tokens::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        // Envía el correo al usuario
        Mail::send('emails.reset_password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        return response()->json(['message' => 'Reset password link sent.']);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required', // Solo se requiere el token
            'password' => 'required|min:8|confirmed', // Nueva contraseña y confirmación
        ]);
    
        // Busca el token en MongoDB
        $passwordReset = password_reset_tokens::where('token', $request->token)->first();
    
        if (!$passwordReset || $passwordReset->created_at->addMinutes(60)->isPast()) {
            return response()->json(['message' => 'Invalid or expired token.'], 400);
        }
    
        // Actualiza la contraseña del usuario asociado al token
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        // Elimina el token usado
        $passwordReset->delete();
    
        return response()->json(['message' => 'Password has been reset.']);
    }
    
    
}
