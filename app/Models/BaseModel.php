<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class BaseModel extends Model
{

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = preg_replace('/\s+/u', '-', trim($value));
        //$this->attributes['slug'] = $this->make_slug($value);
        //$this->attributes['slug'] = str_slug($value);
    }

    /*public function getIDAttribute($value)
    {
        return $id = Crypt::encryptString($value);
    }

    public function setIDAttribute($value)
    {
        $this->attributes['id'] = Crypt::decryptString($value);
    }*/


    public function getStatusAttribute($value)
    {
        return $value == 1?'active':'in-active';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'active'?1:0;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


}