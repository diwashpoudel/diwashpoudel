<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\User as UserTrait;
use  Illuminate\Support\Str;

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
            'actual_cost',
            'featured',
            'brand_id',
            'seller_id'   ,
            'status',
            'created_by'    
        
    ];

    public function getValidationRules($act = 'add')
    {
        $rules =['title'=>'required|string|max:150',
            'category_id'=>'required|exists:categories,id',
            'sub_category_id' =>'nullable|exists:categories, id',
            'summary'=>'required|string',
            'description'=>'nullable|string',
            'price'=>'required|numeric|min:1',
            'discount'=>'nullable|numeric|min:0|max:90',
            'featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'seller_id' => 'nullable|exists:users,id' ,
            'status'=>'sometimes|in:active,inactive',
            'image.*'=>'required|image|max:'.env('MAX_UPLOAD_SIZE',5000)
              
    ];

    if($act != 'add')
    {
        $rules['image.*']= 'sometimes|image|max:'.env('MAX_UPLOAD_SIZE',5000);
 
    }
    return $rules;
}

         public function getSlug($title)
        {
             $slug= Str::slug($title);
             if($this->where('slug',$slug)->count() > 0)
                {
                     $slug .= rand(0,999999999);
                     return $this->getSlug($slug);
                 }
                 return $slug;
         }

        public function categoryInfo()
        {
            return $this->hasOne('App\Models\Category','id','category_id');
        }

        public function subcategoryInfo()
        {
            return $this->hasOne('App\Models\Category','id','sub_category_id');
        }
        public function brandInfo()
        {
            return $this->hasOne('App\Models\Brand','id','brand_id');
        
}
public function sellerInfo()
{
    return $this->hasOne('App\Models\User','id','seller_id');
}

public function getImages()
{
    return $this->hasMany('App\Models\ProductImage','product_id','id');

}
}