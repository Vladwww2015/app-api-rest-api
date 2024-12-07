<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\RestApi\Http\PreloadCustomerGroup;
use Webkul\RestApi\Http\PreloadInventorySource;
use Webkul\RestApi\Http\PreloadProduct;


class ProductCustomerGroupPriceResource extends JsonResource
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
            'value' => $this->value,
            'value_type' => $this->value_type,
            'product_sku' => PreloadProduct::getSkuByProductId((int) $this->product_id),
            'inventory_source_code' => PreloadInventorySource::getCodeById((int) $this->inventory_source_id),
            'customer_group_code' => PreloadCustomerGroup::getCodeById((int) $this->customer_group_id),
            'customer_group_name' => PreloadCustomerGroup::getNameById((int) $this->customer_group_id),
        ];
    }
}
