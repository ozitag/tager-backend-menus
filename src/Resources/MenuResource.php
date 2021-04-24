<?php

namespace OZiTAG\Tager\Backend\Menus\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'label' => $this->label,
            'supportsTree' => false
        ];
    }
}
