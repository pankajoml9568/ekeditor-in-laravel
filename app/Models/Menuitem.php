<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'title',
        'name',
        'slug',
        'type',
        'target',
        'created_at',
        'updated_at'
    ];
}
