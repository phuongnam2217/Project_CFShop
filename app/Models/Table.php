<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $table = 'tables';
    protected $fillable = [
        'name',
        'group_id',
        'chair',
        'note',
        'active',
        'order_id',
    ];

    function group() {
        return $this->belongsTo(Group::class);
    }

    public $timestamps = false;
}
