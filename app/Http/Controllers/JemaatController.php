<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\TambahUserRequest;
use App\Models\HakAkses;
use App\Models\Jemaat;
use App\Models\User;
use Illuminate\Http\Request;

class JemaatController extends Controller
{
    /**
     * menampilkan daftar jemaat
     */
    public function index()
    {
        $data = User::whereHas('hakAkses', function ($query) {
            $query->where('akses', 'Jemaat');
        })->get();
        return view('halaman.jemaat.index', compact('data'));
    }

    /**
     * menampilkan form untuk menambah jemaat baru
     */
    public function create()
    {
        return view('halaman.jemaat.tambah');
    }

    /**
     * menyimpan data jemaat baru
     */
    public function store(TambahUserRequest $request)
    {
        $request->validated();
        $aksesAdmin = HakAkses::where('akses', 'Jemaat')->first();
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'hak_akses_id' => $aksesAdmin->id,
            ]);
            return redirect()->route('jemaat.index')->with('success', 'data jemaat berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan user: ' . $e->getMessage()]);
        }
    }

    /**
     * menampilkan detail jemaat untuk di edit
     */
    public function edit($jemaat)
    {
        $user = User::findOrFail($jemaat);
        return view('halaman.jemaat.edit', compact('user'));
    }

    /**
     * update data jemaat
     */
    public function update(EditUserRequest $request, $jemaat)
    {
        $request->validated();
        $user = User::findOrFail($jemaat);
        $aksesAdmin = HakAkses::where('akses', 'Jemaat')->first();
        try {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'hak_akses_id' => $aksesAdmin->id,
            ]);
            return redirect()->route('jemaat.index')->with('success', 'data jemaat berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengupdate user: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jemaat)
    {
        $user = User::findOrFail($jemaat);
        try {
            $user->delete();
            return redirect()->route('jemaat.index')->with('success', 'data jemaat berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus user: ' . $e->getMessage()]);
        }
    }
}
