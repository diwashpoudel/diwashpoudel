<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id','category_id'];

    public function brands()
    {
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }
}
