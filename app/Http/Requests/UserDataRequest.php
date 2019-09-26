<?php


namespace App\Http\Requests;

use App\Models\Department;
use App\Rules\SearchInModelRule;
use Illuminate\Foundation\Http\FormRequest;

class UserDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'surname' => ['required', 'min:3'],
            'department' => new SearchInModelRule(Department::all())
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validate.profile_name_required'),
            'name.min' => trans('validate.profile_name_min'),
            'surname.required' => trans('validate.profile_surname_required'),
            'surname.min' => trans('validate.profile_surname_min')
        ];
    }
}
