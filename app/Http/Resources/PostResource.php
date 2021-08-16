<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\{UserResource, CategoriaResource};

class PostResource extends JsonResource
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
            'extract'=>$this->extract,
            // 'body'=>$this->body # a conciencia a mostrar.
            'status'=>intval($this->status) == 1 ? "Borrador": "Publicado",
            'user'=>UserResource::make($this->whenLoaded('user')),
            'category'=>CategoriaResource::collection($this->whenLoaded('categoria')),
        );
    }
}
