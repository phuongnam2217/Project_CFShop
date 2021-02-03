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
        'note'
    ];

    public $timestamps = false;

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
