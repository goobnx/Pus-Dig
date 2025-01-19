<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAkunRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAkunRequest;
use App\Http\Requests\UbahPasswordProfilRequest;

class AkunController extends Controller
{
    public function index()
    {
        $judulHalaman = 'Akun';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Akun']
        ];

        $user = User::all();

        return view('akun.index', compact('judulHalaman', 'breadcrumbs', 'user'));
    }

    public function create()
    {
        $judulHalaman = 'Akun';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('akun.index'), 'label' => 'Akun'],
            ['url' => '', 'label' => 'Tambah']
        ];

        return view('akun.create', compact('judulHalaman', 'breadcrumbs'));
    }

    public function store(StoreAkunRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'alamat'   => $request->alamat,
            'role'     => $request->role,
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('akun.index')->with('success', 'Berhasil membuat akun');
    }

    public function edit(string $id_user)
    {
        $judulHalaman = 'Akun';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('akun.index'), 'label' => 'Akun'],
            ['url' => '', 'label' => 'Ubah']
        ];

        $user = User::findOrFail($id_user);

        return view('akun.edit', compact('judulHalaman', 'breadcrumbs', 'user'));
    }

    public function update(UpdateAkunRequest $request, string $id_user)
    {
        $user = User::findOrFail($id_user);

        $user->fill([
            // 'username' => $request->username,
            // 'email'    => $request->email,
            // 'alamat'   => $request->alamat,
            'role'     => $request->role,
        ]);

        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('akun.index')->with('success', 'Berhasil Memperbarui Data');
        } else {
            return redirect()->route('akun.index')->with('info', 'Tidak Ada Perubahan Data');
        }
    }

    public function destroy(string $id_user)
    {
        $user = User::findOrFail($id_user);

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('akun.index')->with('success', 'Berhasil Menghapus Akun');
    }

    public function indexResetPassword(string $id_user)
    {
        $judulHalaman = 'Akun';
        $breadcrumbs = [
            ['url' => route('home.index'), 'label' => 'Home'],
            ['url' => route('akun.index'), 'label' => 'Akun'],
            ['url' => '', 'label' => 'Reset Password']
        ];

        $user = User::findOrFail($id_user);

        return view('akun.resetPassword', compact('judulHalaman', 'breadcrumbs', 'user'));
    }

    public function processResetPassword(UbahPasswordProfilRequest $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        $user->password = Hash::make($request['new_password']);

        $user->save();

        return redirect()->route('index.resetPassword', $id_user)->with('success', 'Berhasil Mengubah Password');
    }
}