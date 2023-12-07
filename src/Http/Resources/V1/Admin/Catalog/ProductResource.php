<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\RestApi\Http\PreloadedProductAttributesStorage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * Not able to use individual key in the resource because
         * attributes are system defined and custom defined.
         *
         * @var array
         */
//        $mainAttributes = $this->resource->toArray(); //SO long process
        $data = [];
        if($columns = $request->input('response_columns')) {
            $columns = explode(',', $columns);
            foreach ($columns as $column) {
                if($column === 'images') {
                    $data[$column] = ProductImageResource::collection($this->{$column});
                    continue;
                }

                if($column === 'videos') {
                    $data[$column] = ProductVideoResource::collection($this->{$column});
                    continue;
                }
                $data[$column] = $this->{$column};
            }
        } else {
            $data = [
                $this->merge($this->getAttributes()),
            ];
        }

        if($request->input('with_attributes') == true) {
            $data = [
                $this->merge(PreloadedProductAttributesStorage::getAttributeValues($this->id)),
                $this->merge($data),
                $this->merge([
                    'videos' => ProductVideoResource::collection($this->videos),
                    'images' => ProductImageResource::collection($this->images)
                ])
            ];
        }

        return $data;
    }
}
