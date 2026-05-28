<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    use HasFactory;

    public const STATUS_DIPINJAM = 'dipinjam';
    public const STATUS_KEMBALI = 'kembali';

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'barang_id',
        'nama_peminjam',
        'jam_pinjam',
        'jam_kembali',
        'guru_pembimbing',
        'qty',
        'status',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'qty' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_DIPINJAM);
    }

    public function scopeSelesai(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_KEMBALI);
    }
}
