<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ~Add softdelete model
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // ~Add softdelete
    use SoftDeletes;

    // ~Add fillable
    protected $fillable = [
        'user_id',
        'category_name',
    ];
}
