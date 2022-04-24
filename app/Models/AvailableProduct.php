<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableProduct extends Model
{
    use HasFactory;

    protected $table = 'available_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','category_id', 'image', 'raw_price', 'unit', 'sale1', 'sale2',
        'sale3', 'day1', 'day2', 'day3', 'contact_info', 'quantity'
    ];

//
//    public function product()
//    {
//        return $this->belongsTo(Product::class, 'product_id', 'id');
//    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

//    public function getNameAttribute()
//    {
//        return $this->product->name;
//    }


    public function getPriceAttribute()
    {
        $now = Carbon::now()->format('Y-m-d');
        $nowCarbon = Carbon::createFromFormat('Y-m-d', $now);
        $expire = Carbon::createFromFormat('Y-m-d', $this->expire_date);

        $days = $expire->diffInDays($nowCarbon);

        $raw = $this->raw_price;

        $d1 = $this->day1;
        $d2 = $this->day2;
        $d3 = $this->day3;

        $s1 = $this->sale1;
        $s2 = $this->sale2;
        $s3 = $this->sale3;

        if ($nowCarbon >= $expire)
            return 0;
        if ($days <= $d3)
            return $raw * (100 - $s3) / 100;
        if ($days <= $d2)
            return $raw * (100 - $s2) / 100;
        if ($days <= $d1)
            return $raw * (100 - $s1) / 100;
        return $raw;
    }
}
