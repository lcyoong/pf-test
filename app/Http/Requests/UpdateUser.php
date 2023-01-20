<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\VerifyRealPhoneNo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name' => ['required', 'max:225'],
            'email' => [
                'required',
                'email',
                'max:225',
                Rule::unique('users', 'email')->ignore($this->input('id'), 'id'),
            ],
            'phone' => ['required']
        ];
    }
}
