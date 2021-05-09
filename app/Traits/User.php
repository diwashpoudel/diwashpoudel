<?php
    namespace App\Traits;
 trait User{
    public function createdBy()
    {
        return $this->hasOne('App\Models\User','id','created_by');
    }
 }
?>