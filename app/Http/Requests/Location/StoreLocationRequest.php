<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreLocationRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'max:30000'],
            'phone_number' => ['required', 'string', 'min:7', 'max:20'],
            'mobile_number' => ['required', 'string', 'min:7', 'max:20'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->error($validator->errors(), 'Validation Error.');
        throw new HttpResponseException($response);
    }
}
