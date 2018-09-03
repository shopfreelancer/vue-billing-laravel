<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    public function getSumTaxedAttribute()
    {
        return $this->price + $this->taxAmount;
    }

    public function getTaxAmountAttribute()
    {
        return ($this->price / 100) * $this->tax_rate;
    }
}
