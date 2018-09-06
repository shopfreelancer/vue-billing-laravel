<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingBaseController extends Controller
{
    /**
     * Method to filter the requests and fill only allowed / fillable attributes of model
     * @param Request $request
     * @param $model
     * @return null
     */
    public function filterModel(Request $request, $model)
    {
        if(!is_object($model)) return null;

        $attributes = $request->all();
        $filteredInputAttributes = $this->getFillableAttributes($attributes, $model);

        if(count($filteredInputAttributes) === 0) return $model;

        foreach ($filteredInputAttributes as $key => $value) {
            $model->$key = $value;
        }

        return $model;
    }

    /**
     * Get only fillable attributes from input model
     * @param $attributes
     * @param $model
     * @return mixed
     */
    public function getFillableAttributes($attributes, $model){

        $fillable = $model->getFillable();

        foreach ($attributes as $key => $attribute) {
            if (!in_array($key, $fillable)) {
                unset($attributes[$key]);
            }
        }
        return $attributes;
    }
}
