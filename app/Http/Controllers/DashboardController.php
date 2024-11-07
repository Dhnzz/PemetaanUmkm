<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{JenisUsaha, Umkm};

class DashboardController extends Controller
{
    public function index()
    {
        $jenisUsaha = JenisUsaha::all();
        $umkm = Umkm::all();
        return view('dashboard', compact('jenisUsaha','umkm'));
    }
}
