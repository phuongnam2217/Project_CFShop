<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id','sub_total','discount','total','check_in','check_out'
    ];
    public $timestamps = false;

    public function products(){
        return $this->belongsToMany(Product::class,'order_details','order_id','product_id')
            ->withPivot(['quantity','priceEach','total','isMaking','created_at','updated_at','release_at']);
    }
}
