<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'parent_email' => ['nullable', 'string', Rule::exists(User::class, 'email')],
            'name'      => ['required'],
            'email'     => ['required', 'email', Rule::unique(User::class, 'email')],
            'password'  => ['required', 'confirmed'],
        ];
    }
}
