<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
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
            'post_id' => 'required|uuid',
            'content' => 'required|string|min:3',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'post_id' => __('models/comment.fillable.post'),
            'content' => __('models/comment.fillable.content'),
        ];
    }
}
