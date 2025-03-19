<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobil extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'mobil';

    protected $fillable = [
        'user_id', 'nopolisi', 'merk', 'kategori', 'kapasitas', 'harga', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
