<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function home()
    {
        $all_users = $this->user->all();
        return view('home')->with('all_users', $all_users);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users'
        ]);

        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->save();

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        return view('edit')->with('user', $user);
    }
}
