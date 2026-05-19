<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'table_barang';

    protected $fillable = [
        'nama_barang', 'jumlah_barang', 'foto', 'deskripsi', 'spesifikasi', 'kondisi'
    ];

    // Relasi dengan DetailPeminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_barang');
    }

    // Scope untuk filter berdasarkan kondisi
    public function scopeKondisi($query, $kondisi)
    {
        return $query->where('kondisi', $kondisi);
    }

    // Scope untuk filter berdasarkan ketersediaan
    public function scopeTersedia($query)
    {
        return $query->where('jumlah_barang', '>', 0);
    }

    // Accessor untuk menampilkan status
    public function getStatusAttribute()
    {
        if ($this->jumlah_barang > 0) {
            return '<span class="badge bg-success">Tersedia</span>';
        }
        return '<span class="badge bg-danger">Habis</span>';
    }

    // Accessor untuk kondisi
    public function getKondisiBadgeAttribute()
    {
        $badges = [
            'baik' => '<span class="badge bg-success">Baik</span>',
            'rusak_ringan' => '<span class="badge bg-warning">Rusak Ringan</span>',
            'rusak_berat' => '<span class="badge bg-danger">Rusak Berat</span>',
            'perbaikan' => '<span class="badge bg-info">Dalam Perbaikan</span>',
        ];
        
        return $badges[$this->kondisi] ?? '<span class="badge bg-secondary">Unknown</span>';
    }
}