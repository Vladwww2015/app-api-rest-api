<?php

namespace Webkul\RestApi\Docs\Admin\Models\Catalog;

/**
 * @OA\Schema(
 *     title="Products-Inventories",
 *     description="Products Inventories model",
 * )
 */
class ProductsInventories
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Inventory Source Code",
     *     description="Inventory Source Code",
     *     example="MEN"
     * )
     *
     * @var string
     */
    private $inventory_source_code;

    /**
     * @OA\Property(
     *     title="SKU",
     *     description="Product SKU",
     *     example="men-t-shirt"
     * )
     *
     * @var string
     */
    private $product_sku;

    /**
     * @OA\Property(
     *     title="Qty",
     *     description="Quantity",
     *     format="int64",
     *     example=150
     * )
     *
     * @var integer
     */
    private $qty;
}
