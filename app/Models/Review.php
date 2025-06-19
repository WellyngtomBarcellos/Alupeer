<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;
    protected $table = 'item_review';

    protected $fillable = [
        'item_id',
        'user_id',
        'star',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTotalStars()
    {
        return self::sum('star');
    }

    public static function getTotalReviews()
    {
        return self::count();
    }

    public static function getAverageRating()
    {
        return self::avg('star');
    }


}
