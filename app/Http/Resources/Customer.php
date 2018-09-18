<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $json =  [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'fullname' => $this->fullname,
            'companyname' => $this->companyname,
            'street' => $this->street,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'country' => $this->country,
            'state' => $this->state,
            'email' => $this->email,
            'tel' => $this->tel,
            'note' => $this->note,
            'current_price' => $this->current_price,
            'ticketsCount' => $this->tickets_count,
            //'posts' => PostResource::collection($this->whenLoaded('posts')),
            'tickets' => $this->whenLoaded('tickets'),
            'invoices' => $this->whenLoaded('invoices'),
        ];

        return $json;
    }
}
