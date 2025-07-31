<?php

namespace App\Http\Requests\Post;

use App\Enum\PostStatus;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:255', Rule::unique(Post::class)->ignore($this->post?->id), 'required'],
            'description' => ['string', 'max:255', 'required'],
            'content' => ['string', 'max:65535', 'required'],
            'status' => [Rule::enum(PostStatus::class), 'nullable'],
        ];
    }
}
