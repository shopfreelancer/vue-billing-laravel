<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
