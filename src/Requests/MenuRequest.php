<?php

namespace OZiTAG\Tager\Backend\Menus\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules()
    {
        return [
            'label' => 'required|string',
            'alias' => ['string', 'required', 'unique:tager_menus,alias,' . $this->route('id')]
        ];
    }
}
