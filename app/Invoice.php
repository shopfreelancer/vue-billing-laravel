<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function items(){
        return $this->hasMany('App\InvoiceItem');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

}
