<?php

namespace App\Http\Requests\V1;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostRequest extends FormRequest
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
                'title' => 'max:225',
                'slug' => 'max:225',
                'status' => 'in:publish,draft,ban',
            ];
        } else {
            return [
                'title' => 'required|max:225',
                'slug' => 'required|max:225|unique:posts,slug',
                'content' => 'required',
                'status' => 'in:publish,draft,ban',
            ];
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResult(__('messages.validate_failed'),
            ['errors' => $validator->errors()], false, 422));
    }
}
