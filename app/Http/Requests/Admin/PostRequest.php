<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:3',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => __('models/post.fillable.title'),
            'content' => __('models/post.fillable.content'),
        ];
    }
}
