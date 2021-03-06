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
            'name' => ['required', 'min:3', 'max:20'],
            'surname' => ['required', 'min:3', 'max:20'],
            'department' => new SearchInModelRule(Department::all())
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validate.field_required'),
            'name.min' => trans('validate.field_min'),
            'name.max' => trans('validate.field_max'),
            'surname.required' => trans('validate.field_required'),
            'surname.min' => trans('validate.field_min'),
            'surname.max' => trans('validate.field_max'),
        ];
    }
}
