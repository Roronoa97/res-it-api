<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'date' => $this->date,
            'total' => $this->total,
            'img' => $this->img,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
