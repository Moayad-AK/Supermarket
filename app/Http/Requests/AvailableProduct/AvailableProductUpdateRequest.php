<?php

namespace App\Http\Requests\AvailableProduct;

use Illuminate\Foundation\Http\FormRequest;

class AvailableProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
//            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'name' => ['sometimes', 'string'],
            'image' => ['sometimes', 'string'],
            'raw_price' => ['sometimes', 'numeric'],
            'unit' => ['sometimes', 'string'],
            'sale1' => ['sometimes', 'integer'],
            'sale2' => ['sometimes', 'integer'],
            'sale3' => ['sometimes', 'integer'],
            'day1' => ['sometimes', 'integer'],
            'day2' => ['sometimes', 'integer'],
            'day3' => ['sometimes', 'integer'],
            'contact_info' => ['sometimes', 'string'],
            'quantity' => ['sometimes', 'integer']

        ];
    }
}
