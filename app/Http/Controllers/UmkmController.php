<?php

namespace App\Http\Controllers;

use App\Models\{Umkm, JenisUsaha, Pemilik};
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

    public function indexPemilik(Pemilik $pemilik)
    {
        $title = 'UMKM';
        $umkm = Umkm::where('pemilik_id', '=', $pemilik->id)->get();
        return view('Umkm.indexPemilik', compact('title', 'umkm', 'pemilik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pemilik $pemilik)
    {
        $title = 'UMKM';
        $subtitle = 'Tambah UMKM';
        $jenisUsaha = JenisUsaha::all();
        return view('Umkm.create', compact('title', 'subtitle', 'jenisUsaha', 'pemilik'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'name' => 'required',
                'sku' => 'required|mimes:pdf|max:2048', // Limit file size to 1MB
                'ktp' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'kk' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'foto_usaha' => 'required|mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
                'modal_awal' => 'required', // Minimum initial capital
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

        $modalAwal = str_replace(['Rp. ', '.'], '', $request->input('modal_awal'));
        $modalAwal = (float) $modalAwal;

        Umkm::create([
            'pemilik_id' => $request->input('pemilik_id'),
            'name' => $request->input('name'),
            'sku' => $skuName,
            'ktp' => $ktpName,
            'kk' => $kkName,
            'foto_usaha' => $foto_usaha_name,
            'modal_awal' => $modalAwal,
            'jenis_usaha_id' => $request->input('jenis_usaha_id'),
            'tahun_berdiri' => $request->input('tahun_berdiri'),
            'no_hp' => $request->input('no_hp'),
            'tenaga_kerja' => $request->input('tenaga_kerja'),
            'pembayaran_digital' => $request->has('pembayaran_digital') ? 1 : 0,
            'long' => $request->input('lng'),
            'lat' => $request->input('lat'),
        ]);

        return redirect()->route('umkm.indexPemilik', $request->input('pemilik_id'))->with('success', 'Berhasil menambah umkm');
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
        $subtitle = 'Edit UMKM';
        $jenisUsaha = JenisUsaha::all();
        return view('Umkm.edit', compact('title', 'subtitle', 'jenisUsaha', 'umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        // $request->validate(
        //     [
        //         'name' => 'required',
        //         'sku' => 'mimes:pdf|max:2048', // Limit file size to 1MB
        //         'ktp' => 'mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
        //         'kk' => 'mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
        //         'foto_usaha' => 'mimes:png,jpg,jpeg|max:2048', // Limit file size to 2MB
        //         'modal_awal' => 'required', // Minimum initial capital
        //         'jenis_usaha_id' => 'required|exists:jenis_usahas,id', // Ensure valid foreign key
        //         'tahun_berdiri' => 'required|date_format:Y', // Validate year format
        //         'no_hp' => 'required|numeric|digits_between:10,13', // Optional phone number with specific length
        //         'tenaga_kerja' => 'required|numeric|min:1', // Optional, minimum 1 worker
        //         'pembayaran_digital' => 'nullable|boolean', // Optional boolean field
        //         'lng' => 'required', // Optional longitude
        //         'lat' => 'required', // Optional latitude
        //     ],
        //     [
        //         'name.required' => 'Nama usaha wajib diisi.',
        //         'sku.mimes' => 'Format file SKU yang diizinkan hanya PDF.',
        //         'sku.max' => 'Ukuran file SKU maksimal 1 MB.',
        //         'ktp.mimes' => 'Format file KTP yang diizinkan hanya PNG, JPG, atau JPEG.',
        //         'ktp.max' => 'Ukuran file KTP maksimal 2 MB.',
        //         'kk.mimes' => 'Format file Kartu Keluarga yang diizinkan hanya PNG, JPG, atau JPEG.',
        //         'kk.max' => 'Ukuran file Kartu Keluarga maksimal 2 MB.',
        //         'foto_usaha.mimes' => 'Format file foto usaha yang diizinkan hanya PNG, JPG, atau JPEG.',
        //         'foto_usaha.max' => 'Ukuran file foto usaha maksimal 2 MB.',
        //         'modal_awal.required' => 'Jumlah modal awal wajib diisi.',
        //         'jenis_usaha_id.required' => 'Jenis usaha harus dipilih.',
        //         'jenis_usaha_id.exists' => 'Jenis usaha yang dipilih tidak valid.',
        //         'tahun_berdiri.required' => 'Tahun berdiri usaha wajib diisi.',
        //         'tahun_berdiri.date_format' => 'Format tahun berdiri tidak valid. Contoh: 2023.',
        //         'no_hp.required' => 'Nomor telepon wajib diisi.',
        //         'no_hp.numeric' => 'Nomor telepon harus berupa angka.',
        //         'no_hp.digits_between' => 'Nomor telepon harus terdiri dari 10-13 digit.',
        //         'tenaga_kerja.required' => 'Jumlah tenaga kerja wajib diisi.',
        //         'tenaga_kerja.numeric' => 'Jumlah tenaga kerja harus berupa angka.',
        //         'tenaga_kerja.min' => 'Jumlah tenaga kerja minimal 1 orang.',
        //         'lng.required' => 'Harap pilih titik di map.',
        //         'lat.required' => 'Harap pilih titik di map.',
        //     ],
        // );

        $sku = $this->fileHandler($request->file('sku'), 'uploads/SKU', $request->input('nib'), $umkm->sku);
        $ktp = $this->fileHandler($request->file('ktp'), 'uploads/KTP', $request->input('nib'), $umkm->ktp);
        $kk = $this->fileHandler($request->file('kk'), 'uploads/KK', $request->input('nib'), $umkm->kk);
        $foto_usaha = $this->fileHandler($request->file('foto_usaha'), 'uploads/FotoUsaha', $request->input('nib'), $umkm->foto_usaha);

        $modalAwal = str_replace(['Rp. ', '.'], '', $request->input('modal_awal'));
        $modalAwal = (float) $modalAwal;

        $umkm->update([
            'name' => $request->input('name'),
            'sku' => $sku,
            'ktp' => $ktp,
            'kk' => $kk,
            'foto_usaha' => $foto_usaha,
            'modal_awal' => $modalAwal,
            'jenis_usaha_id' => $request->input('jenis_usaha_id'),
            'tahun_berdiri' => $request->input('tahun_berdiri'),
            'no_hp' => $request->input('no_hp'),
            'tenaga_kerja' => $request->input('tenaga_kerja'),
            'pembayaran_digital' => $request->has('pembayaran_digital') ? 1 : 0,
            'long' => $request->input('lng'),
            'lat' => $request->input('lat'),
        ]);

        return redirect()
            ->route('umkm.indexPemilik', $request->pemilik_id)
            ->with('success', 'Berhasil mengubah umkm');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        // Define the file paths
        $skuPath = public_path('uploads/SKU/' . $umkm->sku);
        $fotoUsahaPath = public_path('uploads/FotoUsaha/' . $umkm->foto_usaha);
        $ktpPath = public_path('uploads/KTP/' . $umkm->ktp);
        $kkPath = public_path('uploads/KK/' . $umkm->kk);

        // Check if the files exist and delete them
        if (file_exists($skuPath)) {
            unlink($skuPath);
        }
        if (file_exists($fotoUsahaPath)) {
            unlink($fotoUsahaPath);
        }
        if (file_exists($ktpPath)) {
            unlink($ktpPath);
        }
        if (file_exists($kkPath)) {
            unlink($kkPath);
        }

        // Delete the UMKM record
        $umkm->delete();

        return redirect()
            ->route('umkm.indexPemilik', $umkm->pemilik->id)
            ->with('success', 'Berhasil menghapus umkm dan file terkait');
    }

    public function fileHandler($file, $destinationPath, $prefix, $currentFile = null)
    {
        if ($file) {
            $fileName = time() . '-' . rand(1, 100) . '-' . $prefix . '.' . $file->extension();

            $file->move(public_path($destinationPath), $fileName);

            if ($currentFile) {
                unlink(public_path($destinationPath . '/' . $currentFile));
            }

            return $fileName;
        }
        return $currentFile;
    }
}
