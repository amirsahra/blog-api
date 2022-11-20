<?php

namespace App\Http\Requests\V1;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            return [
                'first_name' => 'min:3|max:225',
                'last_name' => 'min:3|max:225',
                'gender' => 'in:female,male,other',
                'type' => 'in:admin,member',
                'status' => 'in:active,ban',
                'phone' => 'numeric|digits:10',
                'email' => 'email|unique:users,email,' . $this->user,
                'avatar' => 'mimes:jpeg,jpg,png,gif|max:20000',
                'password' => 'min:6'
            ];
        } else {
            return [
                'first_name' => 'required|min:3|max:225',
                'last_name' => 'required|min:3|max:225',
                'gender' => 'in:female,male,other',
                'type' => 'in:admin,member',
                'status' => 'in:active,ban',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => 'required|email|unique:users,email',
                'avatar' => 'mimes:jpeg,jpg,png,gif|max:20000',
                'password' => 'required|min:6'
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
