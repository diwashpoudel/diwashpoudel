<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\User as UserTraits;
class Banner extends Model
{
    use HasFactory ,UserTraits;
    protected $fillable =['title','link','image','status','created_by'];

    public function getRules($act='update')
    {
        $rules = array(
            'title'=>'required|string|max:150',
            'link'=>'nullable|url',
             'image'=>'required|image|max:5000',
              'status'=>'required|in:active,inactive'
        );

        if($act == 'update')
        {
            $rules['image'] = 'sometime|image|max:5000';
        }
          return $rules;
    }

   
}
