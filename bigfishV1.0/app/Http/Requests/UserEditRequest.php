<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name'=>'required|max:255|min:2',
            'surname'=>'required|max:255|min:2',
            'email' => 'required|max:255|min:5|unique:users,email,' . auth()->user()->id,
            'bio' => 'max:255',
        ];
    }
}
