<?php

namespace App\Http\Requests\Admin;

use Bouncer;
use Illuminate\Foundation\Http\FormRequest;

class AdminDashboardFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Bouncer::can('admin-dashboard');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['string', 'nullable'],
            'email' => ['string', 'nullable'],
            'role' => ['string', 'nullable'],
        ];
    }
}
