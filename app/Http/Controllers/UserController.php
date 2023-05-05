<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $user;
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';

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
            'email' => 'required|email|max:50|unique:users'
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
            'avatar'=> 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        $user           = $this->user->findOrFail($id);
        $user->name     = $request->name;
        $user->email    = $request->email;

        if ($request->avatar){
            if ($user->avatar){
                $this->deleteAvatar($user->avatar);
            }

            $user->avatar = $this->saveAvatar($request);
        }

        $user->save();

        return redirect()->route('home');
    }

    private function deleteAvatar($image_name)
    {
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if (Storage::disk('local')->exists($avatar_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }

    private function saveAvatar($request)
    {
        $avatar_name = time() . "." . $request->avatar->extension();

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }
}
