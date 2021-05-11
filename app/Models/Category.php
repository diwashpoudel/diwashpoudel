<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\User as UserTraits;
use  Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, UserTraits;

    protected $fillable = ['title','slug','image','parent_id','status','created_by'];

    public function getParentCatsDrop()
    {
        $data = $this->getAllParent()->pluck('title','id');
        return $data;
        // return $this->whereNull('parent_id')->pluck('title','id');
    }
    public function getAllParent()
    {
       return $this->whereNull('parent_id')->get();
    }

    public function getValidationRule()
    {
        return array(
                'title'=>'required|string|max:100',
                'status'=>'required|in:active,inactive',
                'parent_id'=>'nullable|exists:categories,id',
                'image'=>'sometimes|image|max:'.env('MAX_UPLOAD_SIZE',5000),
                'brand_id.*'=>'nullable|exists:brands,id'
        );
    }
        public function getSlug($str)
        {
            $slug = Str::slug($str);
           if ($this->where('slug',$slug)->count()>0)
           {
              $slug =$slug.date('ymdHis');
               return $this->getSlug($slug);
           }

           return $slug;
        }

            public function subCats()
            {
                return $this->hasMany("App\Models\Category","parent_id","id");
            }

            public function brandIds()
            {
                 
                    return $this->hasMany('App\Model\BrandCategory','category_id','id');
                
            }
}
