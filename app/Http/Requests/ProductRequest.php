<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $bypass = $this->product->id ?? "";

        return [
            'field_name_value' => ['string', 'max:255'],
            'field_okdp_value' => 'required|unique:content_type_products,field_okdp_value,'.$bypass,
            'field_alias_value' => 'required|max:50|unique:content_type_products,field_alias_value,'.$bypass,
            'field_price_value' => 'required|numeric|between:0,999999.99',
        ];
    }
}
