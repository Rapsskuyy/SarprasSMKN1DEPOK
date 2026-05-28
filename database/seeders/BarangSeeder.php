<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barang')->insert([
            ['nama' => 'HDMI', 'keterangan' => 'Kabel HDMI standar', 'stock' => 10, 'lokasi' => 'Gudang', 'gambar' => 'img/kabelhdmi.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'VGA', 'keterangan' => 'Kabel VGA standar', 'stock' => 10, 'lokasi' => 'Gudang', 'gambar' => 'img/kabelvga.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Proyektor', 'keterangan' => 'Proyektor Epson/BenQ', 'stock' => 5, 'lokasi' => 'Gudang', 'gambar' => 'img/proyektor.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Speaker', 'keterangan' => 'Speaker Portable', 'stock' => 5, 'lokasi' => 'Gudang', 'gambar' => 'img/speaker.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Mic', 'keterangan' => 'Microphone Wireless/Cable', 'stock' => 5, 'lokasi' => 'Gudang', 'gambar' => 'img/mic.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bola Basket', 'keterangan' => 'Bola Basket Molten', 'stock' => 10, 'lokasi' => 'Gudang Olahraga', 'gambar' => 'img/bolabasket.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bola Sepak', 'keterangan' => 'Bola Sepak Adidas', 'stock' => 10, 'lokasi' => 'Gudang Olahraga', 'gambar' => 'img/bolasepak.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bola Voli', 'keterangan' => 'Bola Voli Mikasa', 'stock' => 10, 'lokasi' => 'Gudang Olahraga', 'gambar' => 'img/bolavoli.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
