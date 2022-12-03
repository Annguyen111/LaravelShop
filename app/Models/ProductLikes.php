<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLikes extends Model
{
    use HasFactory;

    protected $table = 'product_likes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function products(){
        return $this->hasOne(\App\Models\Product::class,'id','product_id');
    }


}
