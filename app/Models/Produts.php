<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produts extends Model
{
    use HasFactory;
    protected $table = 'Product';
    protected $fillable = [
        'item',
        'owner',
    ];
    protected $casts = [
        'item' => 'json'
    ];
}
