<?php

namespace Webkul\RestApi\Http\Resources\V1\Admin\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
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
            'id'                 => $this->id,
            'type'               => $this->type,
            'path'               => $this->path,
            'is_main'            => (bool) $this->is_main,
            'url'                => $this->url,
            'original_image_url' => url($this->url),
            'small_image_url'    => url('cache/small/'.$this->path),
            'medium_image_url'   => url('cache/medium/'.$this->path),
            'large_image_url'    => url('cache/large/'.$this->path),
        ];
    }
}
