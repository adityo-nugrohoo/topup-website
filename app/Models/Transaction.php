<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // created_at dan updated_at aktif secara default, jadi ini opsional:
    public $timestamps = true;
}

