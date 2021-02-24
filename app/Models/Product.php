<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'active',
        'isPortable',
        'image',
        'category_id',
        'menu_id',
    ];


    function category() {
        return $this->belongsTo(Category::class);
    }

    function menu() {
        return $this->belongsTo(Menu::class);
    }

    function importProducts() {
        return$this->hasMany(ImportProduct::class);
    }

    public function getProductImage() {
        return "https://quangvoc8.s3.amazonaws.com/".$this->image;
    }

    public $timestamps = false;

    public function orders(){
        return $this->belongsToMany(Order::class,'order_details','product_id','order_id')
            ->withPivot(['quantity','priceEach','total','isMaking','created_at','updated_at','release_at']);
    }
}
