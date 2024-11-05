<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisUsaha;

class JenisUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisUsaha::create(['name' => 'Pertanian', 'slug' => 'pertanian']);
        JenisUsaha::create(['name' => 'Peternakan', 'slug' => 'peternakan']);
        JenisUsaha::create(['name' => 'Perdagangan', 'slug' => 'perdagangan']);
        JenisUsaha::create(['name' => 'Perindustrian', 'slug' => 'perindustrian']);
        JenisUsaha::create(['name' => 'Pertambangan', 'slug' => 'pertambangan']);
        JenisUsaha::create(['name' => 'Transportasi', 'slug' => 'transportasi']);
        JenisUsaha::create(['name' => 'Pariwisata', 'slug' => 'pariwisata']);
        JenisUsaha::create(['name' => 'Teknologi, Informasi, dan Komunikasi', 'slug' => 'teknologi_informasi_dan_komunikasi']);
        JenisUsaha::create(['name' => 'Jasa', 'slug' => 'jasa']);
        JenisUsaha::create(['name' => 'Formal', 'slug' => 'formal']);
        JenisUsaha::create(['name' => 'Perikanan', 'slug' => 'perikanan']);
        JenisUsaha::create(['name' => 'Informal', 'slug' => 'informal']);
        JenisUsaha::create(['name' => 'F&B (Food & Baverage)', 'slug' => 'f&b_food_&_baverage']);
    }
}
