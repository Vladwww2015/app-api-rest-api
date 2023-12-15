<?php

namespace Webkul\RestApi\Docs\Admin\Models\Catalog;

/**
 * @OA\Schema(
 *     title="ProductCustomerGroupPrice",
 *     description="ProductCustomerGroupPrice model",
 * )
 */
class ProductCustomerGroupPrice
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
     *     title="Qty",
     *     description="Product quantity",
     *     format="int64",
     *     example=150
     * )
     *
     * @var integer
     */
    private $qty;

    /**
     * @OA\Property(
     *     title="Value Type",
     *     description="Discount type unit",
     *     enum={"fixed", "discount"}
     * )
     *
     * @var string
     */
    private $value_type;

    /**
     * @OA\Property(
     *     title="value",
     *     description="Discount amount",
     *     format="int64",
     *     example=5.20
     * )
     *
     * @var float
     */
    private $value;
    
    /**
     * @OA\Property(
     *     title="Product ID",
     *     description="Product's ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $product_id;

    /**
     * @OA\Property(
     *     title="Product SKU",
     *     description="Product's SKU",
     *     example="t-shirt-men"
     * )
     *
     * @var string
     */
    private $product_sku;

    /**
     * @OA\Property(
     *     title="Customer Group Code",
     *     description="Entry belongs to which customer group Code",
     *     example="Wholesale"
     * )
     *
     * @var integer
     */
    private $customer_group_code;

    /**
     * @OA\Property(
     *     title="Customer Group Name",
     *     description="Entry belongs to which customer group Name",
     *     example="Wholesale"
     * )
     *
     * @var integer
     */
    private $customer_group_name;
    
    /**
     * @OA\Property(
     *     title="Customer Group ID",
     *     description="Entry belongs to which customer group ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $customer_group_id;

    /**
     * @OA\Property(
     *     title="Product Source Code",
     *     description="QWE",
     *     example="qwe"
     * )
     *
     * @var string
     */
    private $inventory_source_code;
    
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;
}