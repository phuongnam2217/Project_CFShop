<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportProduct extends Model
{
    use HasFactory;
    protected $table = 'import_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'unit_price',
        'quantity',
        'total_buy',
        'note',
        'create_at',
        'update_at'
    ];

    function product() {
        return $this->belongsTo(Product::class);
    }
}
