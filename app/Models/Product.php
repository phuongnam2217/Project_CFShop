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

//    public function getProductImage () {
//        return "https://quangvoc8.s3.amazonaws.com/".$this->image;
//    }

    function category() {
        return $this->belongsTo(Category::class);
    }

    function menu() {
        return $this->belongsTo(Menu::class);
    }

    public $timestamps = false;
}
