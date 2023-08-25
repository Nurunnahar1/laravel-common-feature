<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['category_id', 'name','slug','is_active'];
    function category(){
        return $this->belongsTo(Category::class);
    }
}
