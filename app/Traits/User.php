<?php
    namespace App\Traits;
    use  Illuminate\Support\Str;
 trait User{
    public function createdBy()
    {
        return $this->hasOne('App\Models\User','id','created_by');
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
 }
?>