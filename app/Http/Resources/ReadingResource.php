<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadingResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'product_id'=>$this->product_id ,
            'reading_entry'=>$this->reading_entry,
            'automatic_count'=>$this->automatic_count,
            'reading_count'=>$this->reading_count,
            'confirm_by_id'=>$this->confirm_by_id,
            'confirmed_at'=>$this->confirmed_at,
            'shift_id'=> $this->shift_id,
            'confirm_status'=>$this->confirm_status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'product'=>new ProductResource($this->whenLoaded('product')),
            'shift'=>new ShiftResource($this->whenLoaded('shift')),
            'user'=>new UserResource($this->whenLoaded('user')),
            'confirm_by'=>new UserResource($this->whenLoaded('confirmBy')),
            'machine'=>new MachineResource($this->whenLoaded('machine')),

        ];
    }
}
