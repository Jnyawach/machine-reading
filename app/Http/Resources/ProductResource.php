<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'product_type'=>$this->productType->name,
            'product_weight'=>$this->productWeight->weight.' Kgs',
            'description'=>$this->description,
            'status'=>$this->status,
            'bale'=>$this->productWeight->packaging_quantity

        ];
    }
}
