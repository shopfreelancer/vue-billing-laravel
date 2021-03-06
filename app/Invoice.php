<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $appends = ['sumNet','sumTaxAmount','sumTotal'];
    protected $fillable = ['title','customer_address','date','text_top','text_bottom','invoice_number'];

    public function items(){
        return $this->hasMany('App\InvoiceItem');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function getSumNetAttribute()
    {
        if(is_null($this->items)) return 0;

        $sum = 0.00;
        foreach($this->items as $item){
            $sum += $item->price;
        }
        return $sum;
    }

    public function getSumTaxAmountAttribute()
    {
        if(is_null($this->items)) return 0;

        $sum = 0.00;
        foreach($this->items as $item){
            $sum += $item->taxAmount;
        }
        return $sum;
    }

    public function getSumTotalAttribute(){
        if(is_null($this->items)) return 0;

        return $this->sumNet + $this->sumTaxAmount;
    }

}
