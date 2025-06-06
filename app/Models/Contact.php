<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'nama', 'email', 'telepon', 'pesan'
    ];
}
