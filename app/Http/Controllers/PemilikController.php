<?php

namespace App\Http\Controllers;

use App\Models\{Pemilik, User};
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pemilik';
        $pemilik = Pemilik::all();
        return view('Pemilik.index', compact('title','pemilik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Pemilik';
        $subtitle = 'Tambah Pemilik';
        return view('Pemilik.create', compact('title','subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nib' =>'required',
            'name' =>'required',
            'no_hp' =>'required',
            'email' =>'required|email',
            'password' =>'required',
        ],[
            'nib.required' => 'Harap isi kolom Nomor Induk Berusaha',
            'name.required' => 'Harap isi kolom nama lengkap',
            'no_hp.required' => 'Harap isi kolom nomor telepon',
            'email.required' => 'Harap isi kolom email',
            'email.email' => 'Harap isi kolom email dengan email yang valid',
            'password.required' => 'Harap isi kolom password',
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'role' => 'pemilik',
            'password' => bcrypt($request->input('password')),
        ]);

        Pemilik::create([
            'name' => $request->input('name'),
            'nib' => $request->input('nib'),
            'no_hp' => $request->input('no_hp'),
            'user_id' => $user->id,
        ]);
        return redirect()->route('pemilik.index')->with('success', 'Berhasil menambahkan pemilik');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemilik $pemilik)
    {
        $title = "Pemilik";
        $subtitle = "Detail Pemilik";

        return view('Pemilik.show', compact('title','subtitle','pemilik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        $title = "Pemilik";
        $subtitle = "Edit Pemilik";
        return view('Pemilik.edit', compact('title','subtitle','pemilik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        $request->validate([
            'nib' =>'required',
            'name' =>'required',
            'no_hp' =>'required',
            'email' =>'required|email',
        ],[
            'nib.required' => 'Harap isi kolom Nomor Induk Berusaha',
            'name.required' => 'Harap isi kolom nama lengkap',
            'no_hp.required' => 'Harap isi kolom nomor telepon',
            'email.required' => 'Harap isi kolom email',
            'email.email' => 'Harap isi kolom email dengan email yang valid',
        ]);

        $user = User::findOrFail($pemilik->user_id);
        if ($request->input('password') == null) {
            $user->update([
                'email' => $request->input('email')
            ]);
        }else{
            $user->update([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);
        }
        return redirect()->route('pemilik.index')->with('success', 'Berhasil menginputkan data pemilik');  ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        //
    }
}
