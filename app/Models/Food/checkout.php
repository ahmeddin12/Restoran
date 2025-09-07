<?php


namespace App\Models\Food;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory;

    protected $table = "checkout";

    protected $fillable = [
        'name',
        'email',
        'town',
        'country',
        'zipcode',
        'phone_number',
        'address',
        'user_id',
        'price',
        'status',
    ];

    public $timestamps = true;
}
