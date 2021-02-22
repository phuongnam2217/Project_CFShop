<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportResource extends Model
{
    use HasFactory;
    protected $table = 'import_resources';
    protected $primaryKey = 'id';

    protected $fillable = [
        'resource_id',
        'unit_price',
        'quantity',
        'total_buy',
        'note',
        'create_at',
        'update_at'
    ];

    function resource() {
        return $this->belongsTo(Resource::class);
    }
}
