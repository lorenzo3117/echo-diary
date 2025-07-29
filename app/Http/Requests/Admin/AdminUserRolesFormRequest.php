<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Http\FormRequest;

class AdminUserRolesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Bouncer::can('roles', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'roles' => ['array', 'exists:roles,id', 'required'],
        ];
    }
}
