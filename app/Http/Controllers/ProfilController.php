<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfilRequest;
use App\Http\Requests\UbahPasswordProfilRequest;

class ProfilController extends Controller
{
    public function index()
    {
        $judulHalaman = 'Profil';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Profil']
        ];

        return view('profil.index', compact('judulHalaman', 'breadcrumbs'));
    }

    public function update(UpdateProfilRequest $request)
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
            return redirect()->route('index.profil')->with('success', 'Profil berhasil diperbarui.');
        }
        
        return redirect()->route('index.profil')->with('info', 'Tidak Ada Perubahan Data.');
    }

    public function indexUbahPassword() {
        $judulHalaman = 'Profil';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('index.profil'), 'label' => 'Profil'],
            ['url' => '', 'label' => 'Ubah Password']
        ];

        return view('profil.ubahPassword', compact('judulHalaman', 'breadcrumbs'));
    }

    public function processUbahPassword(UbahPasswordProfilRequest $request) {
        
        $user = User::findOrFail(Auth::user()->id_user);

        $user->password = Hash::make($request['new_password']);

        $user->save();

        return redirect()->route('index.ubahPassword')->with('success', 'Berhasil Mengubah Password');
    }
}
