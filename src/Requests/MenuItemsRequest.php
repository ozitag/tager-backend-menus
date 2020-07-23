<?php

namespace OZiTAG\Tager\Backend\Menus\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class MenuItemsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'items' => 'required',
            'items.*' => 'array',
            'items.*.label' => 'string|required',
            'items.*.link' => 'nullable|string',
            'items.*.isNewTab' => 'boolean|required',
            'items.*.children' => 'nullable|array',
            'items.*.children.*.label' => 'string|required',
            'items.*.children.*.link' => 'nullable|string',
            'items.*.children.*.isNewTab' => 'boolean|required',
            'items.*.children.*.children' => 'nullable|array',
            'items.*.children.*.children' => 'nullable|array',
            'items.*.children.*.children.*.label' => 'string|required',
            'items.*.children.*.children.*.link' => 'nullable|string',
            'items.*.children.*.children.*.isNewTab' => 'boolean|required',
            'items.*.children.*.children.*.children' => 'nullable|array',
        ];
    }
}
