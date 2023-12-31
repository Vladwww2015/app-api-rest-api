<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerGroupResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'code'       => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
