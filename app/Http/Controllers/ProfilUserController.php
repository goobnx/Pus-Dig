<?php

namespace App\Http\Controllers;

use App\Http\Requests\UbahPasswordProfilRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileUserRequest;

class ProfilUserController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }

    public function update(UpdateProfileUserRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id_user);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('user/photo/profile', 'public');
            $user->photo = $path;
        }

        $user->username = $request->username;
        $user->email    = $request->email;
        $user->alamat   = $request->alamat;

        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('profilUser.index')->with('success', 'Profil berhasil diperbarui.');
        }
        
        return redirect()->route('profilUser.index')->with('info', 'Tidak Ada Perubahan Data.');
    }

    public function indexUbahPassword() {
        return view('user.ubahPassword');
    }

    public function processUbahPassword(UbahPasswordProfilRequest $request) {
        
        $user = User::findOrFail(Auth::user()->id_user);

        $user->password = Hash::make($request['new_password']);

        $user->save();

        return redirect()->route('index.ubahPasswordUser')->with('success', 'Berhasil Mengubah Password');
    }
}