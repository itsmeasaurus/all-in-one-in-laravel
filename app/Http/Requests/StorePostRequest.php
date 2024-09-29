<?php

namespace App\Http\Requests;

use App\Rules\IntegerArray;
use App\Rules\UserExistsInDB;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'user_ids' => ['required', 'array', new IntegerArray, new UserExistsInDB],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'body.string' => 'The body field must be a string.',
            'user_ids.required' => 'The user_ids field is required.',
        ];
    }
}
