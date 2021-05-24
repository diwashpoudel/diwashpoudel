<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\User as userTrait;

class Page extends Model
{
    use HasFactory , userTrait;
    protected $fillable = ['title','slug','summary','detail','image','created_by'];
}
