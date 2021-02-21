<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function apiIndex()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json($user);
    }


    public function apiUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function apiUpdate(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];
        $request->validate($rules);

        if ($request->input('password')) {
            $rules['password'] = 'confirmed';
        }

        $user = User::find($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return response()->json($user);
    }

    public function apiDestroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'Delete user successfuly']);
    }
}
