<?php

namespace App\Http\Requests\Category;

use App\Traits\HttpResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCategoryRequest extends FormRequest
{
    Use HttpResponse;
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
            'description' => ['required', 'string', 'min:2', 'max:255']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = $this->error($validator->errors(), 'Validation Error.');
        throw new HttpResponseException($response);
    }
}
