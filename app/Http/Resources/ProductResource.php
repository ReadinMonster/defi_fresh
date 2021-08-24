<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
          'id' => $this->id,
          'category_id' => $this->category_id,
          'supplier_id' => $this->supplier_id,
          'brand_id' => $this->brand_id,
          'product_name' => $this->product_name,
          'product_quantity' => $this->product_quantity,
          'product_price' => $this->product_price,
        ];
    }
}
