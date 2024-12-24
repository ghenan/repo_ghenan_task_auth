<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email'=>'email',
            'phone_number'=>'max:30',
            'password'=>'required|min:8|max:20'

        ];
    }

    public function messages(): array
    {
        return [
            'email'=>'This Filed is required',
            'phone_number'=>'This Filed is required',
            'password'=>'This Filed is required',

        ];
    }
}
