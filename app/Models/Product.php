<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\User as UserTrait;

class Product extends Model
{
    use HasFactory, UserTrait;
    protected $fillable = [
            'title',
            'slug',
            'category_id',
            'sub_category_id' ,
            'summary',
            'description',
            'price',
            'discount',
            'featured',
            'brand_id',
            'seller_id'   ,
            'status',
            'created_by'    
        
    ];
}
