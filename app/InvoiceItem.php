<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $appends = ['priceWithTax','taxAmount'];
    protected $fillable = ['title','description','tax_rate','price','invoice_id'];

    public function getPriceWithTaxAttribute()
    {
        return $this->price + $this->taxAmount;
    }

    public function getTaxAmountAttribute()
    {
        return ($this->price / 100) * $this->tax_rate;
    }
}
