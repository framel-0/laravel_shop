<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreItemRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer'],
            'unit_of_measure_id' => ['required', 'integer'],
            'location_id' => ['required', 'integer'],
            'sale_price' => ['required', 'integer'],
            'cost_price' => ['required', 'integer'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->error($validator->errors(), 'Validation Error.');
        throw new HttpResponseException($response);
    }
}
