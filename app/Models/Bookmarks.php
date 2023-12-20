<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_user',
        'item_id',
        'item_type'
    ];
}
