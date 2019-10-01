<?php


namespace App\Http\Requests;


use App\Models\Department;
use App\Models\UserRole;
use App\Rules\SearchInModelRule;
use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => ['required', 'unique:users,login'],
            'password' => ['required', 'min:8', 'max:20'],
            'role' => new SearchInModelRule(UserRole::where('id', '>', 1)),
            'name' => ['required', 'min:3', 'max:20'],
            'surname' => ['required', 'min:3', 'max:20'],
            'department' => new SearchInModelRule(Department::all()),
        ];
    }

    public function messages()
    {
        return [
            'login.required' => __('validate.field_required'),
            'login.unique' => __('validate.field_unique'),
            'password.required' => __('validate.field_required'),
            'password.min' => __('validate.field_min'),
            'password.max' => __('validate.field_max'),
            'name.required' => trans('validate.field_required'),
            'name.min' => trans('validate.field_min'),
            'name.max' => trans('validate.field_max'),
            'surname.required' => trans('validate.field_required'),
            'surname.min' => trans('validate.field_min'),
            'surname.max' => trans('validate.field_max'),
        ];
    }
}
