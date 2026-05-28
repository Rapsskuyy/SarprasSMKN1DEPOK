<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@smkn1depok.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Sample Student
        User::create([
            'name' => 'Siswa Example',
            'username' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        // Seed sample barang
        $this->call(BarangSeeder::class);
    }
}
