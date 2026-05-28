<?php

namespace App\Http\Requests;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PinjamRequest extends FormRequest
{
    public function authorize(): bool
    {
        $role = strtolower(trim((string) $this->user()?->role));

        return $role === User::ROLE_SISWA;
    }

    public function rules(): array
    {
        $barang = Barang::find($this->route('id'));
        $maxQty = $barang ? (int) $barang->stock : 999;

        return [
            'nama_peminjam' => ['required', 'string', 'max:255'],
            'jam_pinjam' => ['required', 'string', 'regex:/^\d{1,2}:\d{2}$/'],
            'guru_pembimbing' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer', 'min:1', 'max:' . max(1, $maxQty)],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_peminjam.required' => 'Nama peminjam wajib diisi.',
            'jam_pinjam.required' => 'Jam pinjam wajib diisi.',
            'guru_pembimbing.required' => 'Nama guru pembimbing wajib diisi.',
            'qty.required' => 'Jumlah wajib diisi.',
            'qty.min' => 'Jumlah minimal 1.',
            'qty.max' => 'Jumlah melebihi stok tersedia.',
        ];
    }
}
