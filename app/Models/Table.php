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
        'chair',
        'active',
        'group_id',
        'note',
    ];

    function group() {
        return $this->belongsTo(Group::class);
    }

    public $timestamps = false;

}
