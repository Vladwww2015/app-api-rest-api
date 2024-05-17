<?php

namespace Webkul\RestApi\Http\Controllers\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Core\Http\Requests\MassDestroyRequest;
use Webkul\Product\IsReadyForApiConstraintInterface;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\RestApi\Contracts\ResourceContract;
use Webkul\RestApi\Http\Controllers\V1\V1Controller;
use Webkul\RestApi\Http\PreloadCustomerGroup;
use Webkul\RestApi\Http\PreloadInventorySource;
use Webkul\RestApi\Http\PreloadedProductAttributesStorage;
use Webkul\RestApi\Http\PreloadProduct;
use Webkul\RestApi\Http\PreloadProductCategories;
use Webkul\RestApi\Http\ProductRequestState;
use Webkul\RestApi\Traits\ProvideResource;
use Webkul\RestApi\Traits\ProvideUser;

class ResourceController extends V1Controller implements ResourceContract
{
    use ProvideResource, ProvideUser;

    /**
     * Resource name.
     *
     * Can be customizable in individual controller to change the resource name.
     *
     * @var string
     */
    protected $resourceName = 'Resource(s)';

    /**
     * These are ignored during request.
     *
     * @var array
     */
    protected $requestException = [
        'primary_key',
        'page',
        'limit',
        'pagination',
        'sort',
        'order',
        'token',
        'with_attributes',
        'response_columns'
    ];

    /**
     * Returns a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allResources(Request $request)
    {
        $columnsFromTable = DB::getSchemaBuilder()->getColumnListing($this->getRepositoryInstance()->getTable());

        $primaryColumn = $request->input('primary_key', current($columnsFromTable));

        if($columns = $request->input('response_columns')) {
            $columns = explode(',', $columns);
            ProductRequestState::changeResponseColumns($columns);
            $columns = array_filter($columns, fn($column) => in_array($column, $columnsFromTable));
            $columns[] = $primaryColumn;
            $columns = array_unique($columns);
        }

        $query = $this->getRepositoryInstance()->scopeQuery(function ($query) use ($request, $primaryColumn) {
            foreach ($request->except($this->requestException) as $input => $value) {
                $query = $query->whereIn($input, array_map('trim', explode(',', $value)));
            }

            if ($sort = $request->input('sort')) {
                $query = $query->orderBy($sort, $request->input('order') ?? 'desc');
            } else {
                $query = $query->orderBy($primaryColumn, 'desc');
            }

            return $query;
        });

        if(!$columns) {
            $columns = ['*'];
        } else {
            if($this->getRepositoryInstance() instanceof CategoryRepository) {
                $columns[] = '_lft';
                $columns[] = '_rgt';
            }
        }

        static::prepareByRepositoryType($request, $query);

        if (is_null($request->input('pagination')) || $request->input('pagination')) {
            $results = $query->paginate($request->input('limit') ?? 10);
        } else {
            $results = $query->get();
        }

        if($request->input('with_attributes') == true) {
            ProductRequestState::changeWithAttributes(true);

            PreloadedProductAttributesStorage::preload($results->items(), ProductRequestState::getResponseColumns() ?: ['*']);
        } else {
            $this->prepareDataByTable($results->items(), $this->getRepositoryInstance()->getTable());
        }

        return $this->getResourceCollection($results, $columns);
    }

    /**
     * @param $query
     * @return void
     */
    protected function prepareByRepositoryType(Request $request, $repository)
    {
        if($repository instanceof ProductRepository) {
            if($request->get('ready_to_api_flag', IsReadyForApiConstraintInterface::IS_READY_TO_API_VALUE)) {
                $repository->findByReadyToApiStatus($request->get('ready_to_api_flag', IsReadyForApiConstraintInterface::IS_READY_TO_API_VALUE));
            }
        }
    }

    protected function prepareDataByTable(array $results, string $table)
    {
        switch ($table) {
            case 'product_categories':
                return PreloadProductCategories::preload($results);
            case 'product_customer_group_prices':
                PreloadProduct::preload($results);
                PreloadInventorySource::preload();
                PreloadCustomerGroup::preload();
                return;
            case 'product_inventories':
                PreloadProduct::preload($results);
                PreloadInventorySource::preload();
                return;
        }
    }

    /**
     * Returns an individual resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getResource(int $id)
    {
        $resourceClassName = $this->resource();

        $resource = $this->getRepositoryInstance()->findOrFail($id);

        return new $resourceClassName($resource);
    }

    /**
     * Delete's an individual resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyResource(Request $request, int $id)
    {
        $this->getRepositoryInstance()->findOrFail($id);

        $this->getRepositoryInstance()->delete($id);

        return response([
            'message' => __('rest-api::app.common-response.success.delete', ['name' => $this->resourceName]),
        ]);
    }

    /**
     * To mass delete the resource from storage.
     *
     * @param  \Webkul\Core\Http\Requests\MassDestroyRequest  $request
     * @return \Illuminate\Http\Response
     */
    protected function massDestroyResources(MassDestroyRequest $request)
    {
        $resources = $this->getRepositoryInstance()->findWhereIn('id', $request->indexes);

        if ($resources->isEmpty()) {
            return response([
                'message' => __('rest-api::app.common-response.error.mass-operations.resource-not-found', ['name' => $this->resourceName]),
            ], 404);
        }

        $resources->each(function ($resource) {
            $this->getRepositoryInstance()->delete($resource->id);
        });

        return response([
            'message' => __('rest-api::app.common-response.success.mass-operations.delete', ['name' => $this->resourceName]),
        ]);
    }
}
