<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;

use Webkul\RestApi\Http\ProductRequestState;
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
        $locale = core()->getRequestedLocaleCode() ?: core()->getDefaultChannelLocaleCode();

        $data = [
            ...$this->getAttributes(),
            'locale' => $locale
        ];
        $columns = ProductRequestState::getResponseColumns();
        if(ProductRequestState::checkWithAttributes() == true) {
            $data = [
//                $this->merge($this->resource->toArray()),//SO long process
                ...PreloadedProductAttributesStorage::getAttributeValues($this->id),
                ...$this->getAttributes(),
                'locale' => $locale
            ];

            if(!$columns || in_array('images', $columns)) {
                $data['images'] = ProductImageResource::collection($this->images);
            }

            if(!$columns || in_array('videos', $columns)) {
                $data['videos'] = ProductVideoResource::collection($this->videos);
            }
        }

        if($columns) {
            foreach ($data as $column => $value) {
                if($column === 'id') continue;
                if(!in_array($column, $columns)) unset($data[$column]);
            }
        }

        return $data;
    }
}
