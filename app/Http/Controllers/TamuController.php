<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\TambahUserRequest;
use App\Models\HakAkses;
use App\Models\User;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    /**
     * menampilkan seluruh data.
     */
    public function index()
    {
        $data = User::whereHas('hakAkses', function ($query) {
            $query->where('akses', 'Tamu');
        })->get();
        return view('halaman.tamu.index', compact('data'));
    }

    /**
     * menampilkan halaman untuk menambah data.
     */
    public function create()
    {
        return view('halaman.tamu.tambah');
    }

    /**
     * menyimpan data baru (form admin).
     */
    public function store(TambahUserRequest $request)
    {
        $request->validated();
        $aksesTamu = HakAkses::where('akses', 'Tamu')->first();
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'hak_akses_id' => $aksesTamu->id,
            ]);
            return redirect()->route('tamu.index')->with('success', 'data tamu berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan data tamu: ' . $e->getMessage()]);
        }
    }

    /**
     * tampilkan halaman edit dan menampilkan data.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('halaman.tamu.edit', compact('user'));
    }

    /**
     * update data.
     */
    public function update(EditUserRequest $request, string $id)
    {
        $request->validated();
        $user = User::findOrFail($id);
        $aksesTamu = HakAkses::where('akses', 'Tamu')->first();
        try {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'hak_akses_id' => $aksesTamu->id,
            ]);
            return redirect()->route('tamu.index')->with('success', 'data tamu berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengupdate user: ' . $e->getMessage()]);
        }
    }

    /**
     * hapus data berdasarkan id.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
            return redirect()->route('tamu.index')->with('success', 'data tamu berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus user: ' . $e->getMessage()]);
        }
    }

    public function daftarTamu()
    {
        return view('user.daftar');
    }

    public function prosesDaftarTamu(TambahUserRequest $request)
    {
        $request->validated();
        $aksesTamu = HakAkses::where('akses', 'Tamu')->first();
        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'hak_akses_id' => $aksesTamu->id,
            ]);
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Gagal mendaftar silahkan coba kembali']);
        }
    }
}
