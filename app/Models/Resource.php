<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    protected $table = 'resources';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'note',
    ];

    function unit() {
        return $this->belongsTo(Unit::class);
    }

    function importResources() {
        return$this->hasMany(ImportResource::class);
    }

    public $timestamps = false;
}
