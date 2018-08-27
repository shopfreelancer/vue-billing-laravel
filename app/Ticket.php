<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public const NOT_ACTIVE = 0;
    public const ACTIVE = 1;
    public const BILLED = 2;

    protected $appends = ['status'];

    public function getStatusAttribute(){
        $class = new \ReflectionClass(__CLASS__);
        $constants = array_flip($class->getConstants());

        $status= (is_null($this->status)) ? 0 : $this->status;
        return $constants[$status];
    }
}
