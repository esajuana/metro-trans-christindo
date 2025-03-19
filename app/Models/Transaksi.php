<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'mobil_id',
        'nama',
        'ponsel',
        'instagram',
        'facebook',
        'alamat',
        'alamat_pengiriman',
        'nama_kantor',
        'alamat_kantor',
        'nomor_telp_kantor',
        'nomor_lain',
        'tujuan_sewa',
        'waktu_mulai',
        'waktu_selesai',
        'waktu_pengembalian',
        'total_pembayaran',
        'dp',
        'sisa_pembayaran',
        'denda',
        'status_pembayaran',
        'metode_pembayaran',
        'status_transaksi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
