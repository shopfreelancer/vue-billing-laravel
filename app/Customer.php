<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $appends = ['fullname'];

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }

    public function invoices(){
        return $this->hasMany('App\Invoice');
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
