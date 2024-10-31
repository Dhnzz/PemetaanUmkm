<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Jenis Usaha';
        $jenisUsaha = JenisUsaha::all();
        return view('JenisUsaha.index', compact('title','jenisUsaha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Jenis Usaha';
        $subtitle = 'Tambah Jenis Usaha';
        return view('JenisUsaha.create', compact('title','subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Harap isi kolom nama jenis usaha'
        ]);

        $jenisUsaha = JenisUsaha::create([
            'name' => $request->input('name'),
            'slug' => Str::lower($request->input('name'))
        ]);
        return redirect()->route('jenis-usaha.index')->with('success','Berhasil menambahkan jenis usaha');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisUsaha $jenisUsaha)
    {
        $title = 'Jenis Usaha';
        $subtitle = 'Detail Jenis Usaha';
        return view('JenisUsaha.show', compact('jenisUsaha','title','subtitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisUsaha $jenisUsaha)
    {
        $title = 'Jenis Usaha';
        $subtitle = 'Edit Jenis Usaha';
        return view('JenisUsaha.edit', compact('jenisUsaha','title','subtitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisUsaha $jenisUsaha)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Harap isi kolom nama jenis usaha'
        ]);

        $jenisUsaha->update([
            'name' => $request->input('name'),
            'slug' => Str::lower($request->input('name'))
        ]);
        return redirect()->route('jenis-usaha.index')->with('success', 'Berhasil mengubah jenis usaha');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisUsaha $jenisUsaha)
    {
        $jenisUsaha->delete();
        return redirect()->route('jenis-usaha.index')->with('success', 'Berhasil menghapus jenis usaha');
    }
}
