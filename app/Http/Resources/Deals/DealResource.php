<?php

namespace App\Http\Resources\Deals;

use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
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
            'id'                        => $this->id,
            'country'                      => $this->country,
            'deal_type'                     => $this->estateType,
            'estate_type'                     => $this->dealType,
            'from_us'                     => $this->from_us,
            'deal_value'                     => $this->deal_value,
            'is_active'               => $this->is_active,
            'created_at'                     => $this->created_at,
        ];
    }
}
