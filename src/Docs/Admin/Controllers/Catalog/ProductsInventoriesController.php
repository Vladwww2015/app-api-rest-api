<?php

namespace Webkul\RestApi\Docs\Admin\Controllers\Catalog;

class ProductsInventoriesController
{
    /**
     * @OA\Get(
     *      path="/api/v1/admin/catalog/products-inventories",
     *      operationId="getProductsInventories",
     *      tags={"Products-Inventories"},
     *      summary="Get admin catalog products-invetories list",
     *      description="Returns catalog products-invetories list, if you want to retrieve all catalog products inventories at once pass pagination=0 otherwise ignore this parameter",
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
     *                  @OA\Items(ref="#/components/schemas/ProductsInventories")
     *              )
     *          )
     *      )
     * )
     */
    public function list()
    {
    }
}
