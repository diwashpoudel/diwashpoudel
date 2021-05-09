<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\User as UserTraits ;

class Brand extends Model
{
    use HasFactory , UserTraits;
    protected $fillable =['title','image','created_by'];

    public function getRules($act='update')
    {
        $rules = array(
            'title'=>'required|string|max:150',
            'image'=>'required|image|max:5000',
               
        );

        if($act == 'update')
        {
            $rules['image'] = 'sometime|image|max:5000';
        }
          return $rules;
    }



}
