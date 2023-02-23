<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(1);
        return view('scenes.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|numeric|max:1',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        if($user)
        {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|numeric|max:1',
        ]);
        $user = User::find($id);
        if(!$user)
        {
            return back()->with('Error', 'Can not find user');
        }
        $user->update($request->all());
        return back();

    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user)
        {
            return back()->with('Error', 'Can not find user');
        }
        $user->delete();
        return back();
    }
}
