<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $rootCategory = $this->_getRootCategoryId();
        $rootCategoryId = $rootCategory->id;
        if($columns = $request->input('response_columns')) {
            $columns = explode(',', $columns);
            $data = [
                'is_root' => (int) $rootCategoryId === (int) $this->id
            ];
            foreach ($columns as $column) {
                if($column === 'is_root') continue;
                if($column === 'category_icon_path') {
                    $data[$column] = $this->_getCategoryIconPath();
                    continue;
                }
                if($column === 'additional') {
                    $data[$column] = $this->_getAdditional();
                    continue;
                }
                $data[$column] = $this->{$column};
            }
        } else {
            $data = [
                'id'                 => $this->id,
                'name'               => $this->name,
                'code'               => $this->code,
                'parent_code'        => $this->parent_code,
                'parent_id'          => $this->parent_id,
                'is_root' => (int) $rootCategoryId === (int) $this->id,
                'slug'               => $this->slug,
                'display_mode'       => $this->display_mode,
                'description'        => $this->description,
                'meta_title'         => $this->meta_title,
                'meta_description'   => $this->meta_description,
                'meta_keywords'      => $this->meta_keywords,
                'status'             => $this->status,
                'image_url'          => $this->image_url,
                'category_icon_path' => $this->category_icon_path
                    ? Storage::url($this->category_icon_path)
                    : null,
                'additional'         => is_array($this->resource->additional)
                    ? $this->resource->additional
                    : json_decode($this->resource->additional, true),
                'created_at'         => $this->created_at,
                'updated_at'         => $this->updated_at,
            ];
        }

        return $data;
    }

    protected function _getCategoryIconPath()
    {
        return $this->category_icon_path
            ? Storage::url($this->category_icon_path)
            : null;
    }

    protected function _getAdditional()
    {
        return is_array($this->resource->additional)
            ? $this->resource->additional
            : json_decode($this->resource->additional, true);
    }

    protected function _getRootCategoryId()
    {
        return $this->resource->getRootCategory();
    }
}
