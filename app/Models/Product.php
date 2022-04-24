<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'category_id'
    ];

//    public function category()
//    {
//        return $this->belongsTo(Category::class, 'category_id', 'id');
//    }
//
//    public function availableProducts()
//    {
//        return $this->hasMany(AvailableProduct::class, 'product_id', 'id')
//            ->whereDate('expire_date', '>', Carbon::now()->format('Y-m-d'));
//    }
//
//    public function users()
//    {
//        return $this->belongsToMany(User::class, 'available_products', 'product_id',
//            'user_id');
//    }


    /*
     "sales": {
        "days": [12, 30, 40],
        "sales": [12, 40, 80]
    }

     "sales": [
            {
                "day": 12,
                "sale": 12
            },
            {
                "day": 30,
                "sale": 40
            },
            {
                "day": 40,
                "sale": 80
            },
        ]
     */
}
