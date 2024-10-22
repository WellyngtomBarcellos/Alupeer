<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'item_id',
        'date',
        'user_id',
        'owner',
    ];

    // Relaciona com o modelo Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    // Relaciona com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user_owner()
    {
        return $this->belongsTo(user::class, 'owner');
    }
    public function img()
    {
        return $this->hasMany(Image::class, 'item_id', 'item_id');
    }
}