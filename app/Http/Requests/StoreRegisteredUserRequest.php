<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisteredUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
        'full_name' => 'required|string',
         'email' => 'required|email|unique:registered_users,email',
         'mobile' => 'required|string|max:20',
         'job_title' => 'required|string',
         'company' => 'required|string',
];

    }
}
