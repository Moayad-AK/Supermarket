<?php

namespace App\Http\Requests\AvailableProduct;

use Illuminate\Foundation\Http\FormRequest;

class AvailableProductStoreRequest extends FormRequest
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
//            'user_id' => ['required', 'integer', 'exists:users,id'],
//            'product_id' => ['required', 'integer', 'exists:products,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'image' => ['required', 'string'],
            'expire_date' => ['required', 'date_format:Y-m-d'],
            'raw_price' => ['required', 'numeric'],
            'unit' => ['required', 'string'],
            'sale1' => ['required', 'integer'],
            'sale2' => ['required', 'integer'],
            'sale3' => ['required', 'integer'],
            'day1' => ['required', 'integer'],
            'day2' => ['required', 'integer'],
            'day3' => ['required', 'integer'],
            'contact_info' => ['required', 'string'],
            'quantity' => ['required', 'integer']
        ];
    }
}
