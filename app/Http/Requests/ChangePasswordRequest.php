<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'new_password' => ['required', 'min:8', 'max:20'],
            're_password' => ['same:new_password']
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => __('validate.field_required'),
            'new_password.min' => __('validate.field_min'),
            'new_password.max' => __('validate.field_max'),
            're_password.same' => __('validate.user_password_same'),
        ];
    }
}
