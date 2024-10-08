<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'customer_code'   => $this->getCustomer()->number_external,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'company_name' => $this->company_name,
            'vat_id'       => $this->vat_id,
            'address1'     => explode(PHP_EOL, $this->address1),
            'country'      => $this->country,
            'email'      => $this->email,
            'customer_id'      => $this->customer_id,
            'address_type'      => $this->address_type,
            'country_name' => core()->country_name($this->country),
            'state'        => $this->state,
            'city'         => $this->city,
            'postcode'     => $this->postcode,
            'phone'        => $this->phone,
            'is_default'   => $this->default_address,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
