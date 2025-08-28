<?php


namespace App\Models\Food;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $fillable = [
        'user_id',
        'food_id',
        'name',
        'price',
        'image',
    ];

    public $timestamps = true;
}
