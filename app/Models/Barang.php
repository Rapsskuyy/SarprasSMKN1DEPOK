<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama',
        'keterangan',
        'stock',
        'lokasi',
        'gambar',
    ];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
        ];
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }

    public function getGambarUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }

        $path = trim($this->gambar);

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (
            str_starts_with($path, 'storage/') ||
            str_starts_with($path, 'img/') ||
            str_starts_with($path, 'build/')
        ) {
            return asset($path);
        }

        if (file_exists(public_path('img/' . $path))) {
            return asset('img/' . $path);
        }

        if (file_exists(public_path('build/img/' . $path))) {
            return asset('build/img/' . $path);
        }

        return asset($path);
    }
}
