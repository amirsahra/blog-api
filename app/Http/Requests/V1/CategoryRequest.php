<?php

namespace App\Http\Requests\V1;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{
    use ApiResponse;

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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'title' => 'min:3|max:225|unique:categories,title,' . $this->category,
                'slug' => 'min:3|max:225|unique:categories,slug,' . $this->category,
                'is_active' => 'in:1,0',
            ];
        } else {
            return [
                'title' => 'required|min:3|max:225|unique:categories,title',
                'slug' => 'required|min:3|max:225|unique:categories,title',
                'is_active' => 'in:1,0',
                'parent_id' => 'exists:categories,id',
            ];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResult(__('messages.validate_failed'),
            ['errors' => $validator->errors()], false, 422
        ));
    }
}
