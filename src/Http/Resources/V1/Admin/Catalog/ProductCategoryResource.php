<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\RestApi\Http\PreloadProductCategories;


class ProductCategoryResource extends JsonResource
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
            'product_sku' => PreloadProductCategories::getSkuByProductId($this->product_id),
            'category_code' => PreloadProductCategories::getCodeByCategoryId($this->category_id),
        ];
    }
}
