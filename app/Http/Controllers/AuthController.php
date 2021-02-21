<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function me(Request $request)
    {
        return $request->user();
    }

    public function apiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken("token")->plainTextToken;
    }

    public function apiRegister(Request $request)
    {
        $request->validate([
            'name' => "required",
            'email' => "required|email",
            'password' => "required|confirmed|min:4",
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json($user);
    }

    public function apiLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => "You are logout successfuly !"]);
    }
}
