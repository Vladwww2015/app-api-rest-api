<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\RestApi\Http\PreloadInventorySource;
use Webkul\RestApi\Http\PreloadProduct;

class ProductsInventoriesResource extends JsonResource
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
            'id' => $this->id,
            'qty' => $this->qty,
            'inventory_source_code' => PreloadInventorySource::getCodeById($this->inventory_source_id),
            'product_sku' => PreloadProduct::getSkuByProductId($this->product_id),
        ];
    }
}
