<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'stock' => $this->stock,
            'available' => $this->stock > 0,
            'stock_label' => match (true) {
                $this->stock == 0 => 'Habis',
                $this->stock < 3 => 'Menipis',
                default => 'Aman',
            },
            'location' => $this->location,
            'category' => $this->whenLoaded('category', fn() => $this->category->name),
        ];
    }
}
