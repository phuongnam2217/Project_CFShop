<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'name'
    ];

    function tables() {
        return $this->hasMany(Table::class);
    }

    public $timestamps = false;

    public function tables(){
        return $this->hasMany(Table::class);
    }
}
