<?php

namespace Webkul\RestApi\Docs\Admin\Models\Catalog;

/**
 * @OA\Schema(
 *     title="ProductCategory",
 *     description="Product Category model",
 * )
 */
class ProductCategory
{
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
     *     title="CODE",
     *     description="Category Unique Code",
     *     example="MEN"
     * )
     *
     * @var string
     */
    private $category_code;
}