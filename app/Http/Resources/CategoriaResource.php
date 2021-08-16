<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PostResource;


class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return array(
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'posts'=>PostResource::collection($this->whenLoaded('posts')), //Se evita que, en caso que no se pida posts, de error
        );
    }
}
