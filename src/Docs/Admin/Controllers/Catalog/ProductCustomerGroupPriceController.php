<?php

namespace Webkul\RestApi\Docs\Admin\Controllers\Catalog;

class ProductCustomerGroupPriceController
{
    /**
     * @OA\Get(
     *      path="/api/v1/admin/catalog/products-customer-group-prices",
     *      operationId="getProductsCustomerGroupPrices",
     *      tags={"Products-Customer-Group-Price"},
     *      summary="Get admin catalog product customer group price list",
     *      description="Returns catalog product customer group price list, if you want to retrieve all catalog products at once pass pagination=0 otherwise ignore this parameter",
     *      security={ {"sanctum_admin": {} }},
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="limit",
     *          description="Limit",
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/ProductCustomerGroupPrice")
     *              )
     *          )
     *      )
     * )
     */
    public function list()
    {
    }
}
