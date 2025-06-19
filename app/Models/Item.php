<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'name_item',
        'owner',
        'price',
        'category',
        'descricao',
        'float',
        'long',
        'lat',
        'reservado',
        'token',
    ];
    public function reviews() // Um item pode ter muitas revisões
    {
        return $this->hasMany(Review::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'item_id', 'id');
    }

    public function users() // Um item pode ter muitas imagens
    {
        return $this->belongsTo(User::class, 'owner'); // O nome do método foi corrigido para plural
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'item_id'); // Correção da chave estrangeira
    }

    protected $appends = ['classification'];

    public function getClassificationAttribute()
    {
        $totalEstrelas = $this->reviews->sum('star');
        $totalClassificacoes = $this->reviews->count();
        return $totalClassificacoes ? number_format($totalEstrelas / $totalClassificacoes, 1) : 0;
    }

}
