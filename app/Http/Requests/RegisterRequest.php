<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'full_name'=>'required|max:30',
            'email'=>'required|email',
            'phone_number'=>'required|max:30',
            'profile_photo'=>'required|mimes:jpg,bmp,png',
            'password'=>'required|min:8|max:20'

        ];
    }

    public function messages(): array
    {
        return [
            'full_name'=>'This Filed is required',
            'email'=>'This Filed is required',
            'phone_number'=>'This Filed is required',
            'profile_photo'=>'This Filed is required|Image type is not supported',
            'password'=>'This Filed is required',

        ];
    }
}
