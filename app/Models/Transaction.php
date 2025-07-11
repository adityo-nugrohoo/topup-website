<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Jika tabel memiliki kolom created_at dan updated_at
    public $timestamps = true;

    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'user_id',
        'game',
        'player_id',
        'email',
        'amount',
        'payment_method',
        'status',
    ];
}
