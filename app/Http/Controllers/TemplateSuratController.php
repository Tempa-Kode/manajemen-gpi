<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $data = TemplateSurat::all();
        return view('halaman.template_surat.index', compact('data'));
    }

    public function create()
    {
        return view('halaman.template_surat.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'template' => 'required',
            'nama_field.*' => 'required|string|max:255',
            'label' => 'required|array|min:1',
            'label.*' => 'required|string|max:255',
            'tipe' => 'required|array|min:1',
            'tipe.*' => 'required|in:text,number,date,textarea,select',
        ]);

        DB::beginTransaction();
        try {
            $filePath = $request->file('template')->store('templatesurat');
            $template = TemplateSurat::create([
                'nama_template' => $request->nama_template,
                'deskripsi' => $request->deskripsi,
                'path_file' => $filePath,
            ]);

            foreach ($request->nama_field as $i => $namaField) {
                \App\Models\IsianTemplate::create([
                    'template_id' => $template->id,
                    'nama_field' => $namaField,
                    'label' => $request->label[$i],
                    'tipe' => $request->tipe[$i],
                ]);
            }

            DB::commit();
            return redirect()->route('template-surat.index')->with('success', 'Template surat berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan template surat: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $template = TemplateSurat::findOrFail($id)->with('isianTemplates')->first();
        return view('halaman.template_surat.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_template' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'template' => 'nullable|file',
            'nama_field.*' => 'required|string|max:255',
            'label' => 'required|array|min:1',
            'label.*' => 'required|string|max:255',
            'tipe' => 'required|array|min:1',
            'tipe.*' => 'required|in:text,number,date,textarea,select',
        ]);

        DB::beginTransaction();
        try {
            $template = TemplateSurat::findOrFail($id);
            if ($request->hasFile('template')) {
                if ($template->path_file) {
                    \Storage::delete($template->path_file);
                }
                $filePath = $request->file('template')->store('templatesurat');
                $template->path_file = $filePath;
            }

            $template->nama_template = $request->nama_template;
            $template->deskripsi = $request->deskripsi;
            $template->save();

            // Hapus isian template lama
            \App\Models\IsianTemplate::where('template_id', $id)->delete();

            // Tambah isian template baru
            foreach ($request->nama_field as $i => $namaField) {
                \App\Models\IsianTemplate::create([
                    'template_id' => $id,
                    'nama_field' => $namaField,
                    'label' => $request->label[$i],
                    'tipe' => $request->tipe[$i],
                ]);
            }

            DB::commit();
            return redirect()->route('template-surat.index')->with('success', 'Template surat berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui template surat: ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);
        if ($template->path_file) {
            \Storage::delete($template->path_file);
        }
        $template->delete();
        return redirect()->route('template-surat.index')->with('success', 'Template surat berhasil dihapus.');
    }
}
