<?php

namespace App\Http\Controllers;

use App\Models\{Umkm, JenisUsaha};
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'UMKM';
        $umkm = Umkm::all();
        return view('Umkm.index', compact('title', 'umkm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'UMKM';
        $subtitle = 'Tambah UMKM';
        $jenisUsaha = JenisUsaha::all();
        return view('Umkm.create', compact('title', 'subtitle', 'jenisUsaha'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->lat);
        $request->validate(
            [
                'name' => 'required',
                'nib' => 'required|numeric', // Ensure 13-digit NIB
                'sku' => 'required|mimes:pdf|max:2048', // Limit file size to 1MB
                'ktp' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'kk' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'foto_usaha' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'modal_awal' => 'required|numeric|min:1000', // Minimum initial capital
                'jenis_usaha_id' => 'required|exists:jenis_usahas,id', // Ensure valid foreign key
                'tahun_berdiri' => 'required|date_format:Y', // Validate year format
                'no_hp' => 'required|numeric|digits_between:10,13', // Optional phone number with specific length
                'tenaga_kerja' => 'required|numeric|min:1', // Optional, minimum 1 worker
                'pembayaran_digital' => 'nullable|boolean', // Optional boolean field
                'lng' => 'required', // Optional longitude
                'lat' => 'required', // Optional latitude
            ],
            [
                'name.required' => 'Nama usaha wajib diisi.',
                'nib.required' => 'Nomor Induk Berusaha (NIB) wajib diisi.',
                'nib.numeric' => 'NIB harus berupa angka.',
                'sku.required' => 'Silakan unggah file SKU.',
                'sku.mimes' => 'Format file SKU yang diizinkan hanya PDF.',
                'sku.max' => 'Ukuran file SKU maksimal 1 MB.',
                'ktp.required' => 'Silakan unggah fotokopi KTP.',
                'ktp.mimes' => 'Format file KTP yang diizinkan hanya PNG, JPG, atau JPEG.',
                'ktp.max' => 'Ukuran file KTP maksimal 2 MB.',
                'kk.required' => 'Silakan unggah fotokopi Kartu Keluarga.',
                'kk.mimes' => 'Format file Kartu Keluarga yang diizinkan hanya PNG, JPG, atau JPEG.',
                'kk.max' => 'Ukuran file Kartu Keluarga maksimal 2 MB.',
                'foto_usaha.required' => 'Silakan unggah foto usaha Anda.',
                'foto_usaha.mimes' => 'Format file foto usaha yang diizinkan hanya PNG, JPG, atau JPEG.',
                'foto_usaha.max' => 'Ukuran file foto usaha maksimal 2 MB.',
                'modal_awal.required' => 'Jumlah modal awal wajib diisi.',
                'modal_awal.numeric' => 'Jumlah modal awal harus berupa angka.',
                'modal_awal.min' => 'Jumlah modal awal minimal Rp1.000.000.',
                'jenis_usaha_id.required' => 'Jenis usaha harus dipilih.',
                'jenis_usaha_id.exists' => 'Jenis usaha yang dipilih tidak valid.',
                'tahun_berdiri.required' => 'Tahun berdiri usaha wajib diisi.',
                'tahun_berdiri.date_format' => 'Format tahun berdiri tidak valid. Contoh: 2023.',
                'no_hp.required' => 'Nomor telepon wajib diisi.',
                'no_hp.numeric' => 'Nomor telepon harus berupa angka.',
                'no_hp.digits_between' => 'Nomor telepon harus terdiri dari 10-13 digit.',
                'tenaga_kerja.required' => 'Jumlah tenaga kerja wajib diisi.',
                'tenaga_kerja.numeric' => 'Jumlah tenaga kerja harus berupa angka.',
                'tenaga_kerja.min' => 'Jumlah tenaga kerja minimal 1 orang.',
                'lng.required' => 'Harap pilih titik di map.',
                'lat.required' => 'Harap pilih titik di map.',
            ],
        );

        // SKU
        $sku = $request->file('sku');
        $skuName = time() . '-' . rand(1, 100) . '-' . $request->input('nib') . '.' . $sku->extension();
        $sku->move(public_path('uploads/SKU'), $skuName);
        // Foto Usaha
        $foto_usaha = $request->file('foto_usaha');
        $foto_usaha_name = time() . '-' . rand(1, 100) . '-' . $request->input('nib') . '.' . $foto_usaha->extension();
        $foto_usaha->move(public_path('uploads/FotoUsaha'), $foto_usaha_name);
        // KTP
        $ktp = $request->file('ktp');
        $ktpName = time() . '-' . rand(1, 100) . '-' . $request->input('nib') . '.' . $ktp->extension();
        $ktp->move(public_path('uploads/KTP'), $ktpName);
        // KK
        $kk = $request->file('kk');
        $kkName = time() . '-' . rand(1, 100) . '-' . $request->input('nib') . '.' . $kk->extension();
        $kk->move(public_path('uploads/KK'), $kkName);

        Umkm::create([
            'name' => $request->input('name'),
            'nib' => $request->input('nib'),
            'sku' => $skuName,
            'ktp' => $ktpName,
            'kk' => $kkName,
            'foto_usaha' => $foto_usaha_name,
            'modal_awal' => $request->input('modal_awal'),
            'jenis_usaha_id' => $request->input('jenis_usaha_id'),
            'tahun_berdiri' => $request->input('tahun_berdiri'),
            'no_hp' => $request->input('no_hp'),
            'tenaga_kerja' => $request->input('tenaga_kerja'),
            'pembayaran_digital' => $request->input('pembayaran_digital') == null ? 0 : 1,
            'long' => $request->input('lng'),
            'lat' => $request->input('lat'),
        ]);

        return redirect()->route('umkm.index')->with('success', 'Berhasil menambah umkm');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        $title = 'UMKM';
        $subtitle = 'Detail UMKM';
        return view('Umkm.show', compact('title', 'subtitle', 'umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        $title = 'UMKM';
        $subtitle = 'Detail UMKM';
        $jenisUsaha = JenisUsaha::all();
        return view('Umkm.create', compact('title', 'subtitle', 'jenisUsaha', 'umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        $request->validate(
            [
                'name' => 'required',
                'nib' => 'required|numeric', // Ensure 13-digit NIB
                'sku' => 'required|mimes:pdf|max:2048', // Limit file size to 1MB
                'ktp' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'kk' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'foto_usaha' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'modal_awal' => 'required|numeric|min:1000', // Minimum initial capital
                'jenis_usaha_id' => 'required|exists:jenis_usahas,id', // Ensure valid foreign key
                'tahun_berdiri' => 'required|date_format:Y', // Validate year format
                'no_hp' => 'required|numeric|digits_between:10,13', // Optional phone number with specific length
                'tenaga_kerja' => 'required|numeric|min:1', // Optional, minimum 1 worker
                'pembayaran_digital' => 'nullable|boolean', // Optional boolean field
                'lng' => 'required', // Optional longitude
                'lat' => 'required', // Optional latitude
            ],
            [
                'name.required' => 'Nama usaha wajib diisi.',
                'nib.required' => 'Nomor Induk Berusaha (NIB) wajib diisi.',
                'nib.numeric' => 'NIB harus berupa angka.',
                'sku.required' => 'Silakan unggah file SKU.',
                'sku.mimes' => 'Format file SKU yang diizinkan hanya PDF.',
                'sku.max' => 'Ukuran file SKU maksimal 1 MB.',
                'ktp.required' => 'Silakan unggah fotokopi KTP.',
                'ktp.mimes' => 'Format file KTP yang diizinkan hanya PNG, JPG, atau JPEG.',
                'ktp.max' => 'Ukuran file KTP maksimal 2 MB.',
                'kk.required' => 'Silakan unggah fotokopi Kartu Keluarga.',
                'kk.mimes' => 'Format file Kartu Keluarga yang diizinkan hanya PNG, JPG, atau JPEG.',
                'kk.max' => 'Ukuran file Kartu Keluarga maksimal 2 MB.',
                'foto_usaha.required' => 'Silakan unggah foto usaha Anda.',
                'foto_usaha.mimes' => 'Format file foto usaha yang diizinkan hanya PNG, JPG, atau JPEG.',
                'foto_usaha.max' => 'Ukuran file foto usaha maksimal 2 MB.',
                'modal_awal.required' => 'Jumlah modal awal wajib diisi.',
                'modal_awal.numeric' => 'Jumlah modal awal harus berupa angka.',
                'modal_awal.min' => 'Jumlah modal awal minimal Rp1.000.000.',
                'jenis_usaha_id.required' => 'Jenis usaha harus dipilih.',
                'jenis_usaha_id.exists' => 'Jenis usaha yang dipilih tidak valid.',
                'tahun_berdiri.required' => 'Tahun berdiri usaha wajib diisi.',
                'tahun_berdiri.date_format' => 'Format tahun berdiri tidak valid. Contoh: 2023.',
                'no_hp.required' => 'Nomor telepon wajib diisi.',
                'no_hp.numeric' => 'Nomor telepon harus berupa angka.',
                'no_hp.digits_between' => 'Nomor telepon harus terdiri dari 10-13 digit.',
                'tenaga_kerja.required' => 'Jumlah tenaga kerja wajib diisi.',
                'tenaga_kerja.numeric' => 'Jumlah tenaga kerja harus berupa angka.',
                'tenaga_kerja.min' => 'Jumlah tenaga kerja minimal 1 orang.',
                'lng.required' => 'Harap pilih titik di map.',
                'lat.required' => 'Harap pilih titik di map.',
            ],
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        //
    }
}
