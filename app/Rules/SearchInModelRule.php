<?php


namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SearchInModelRule implements Rule
{
    public $modelObject;

    public function __construct($modelObject)
    {
        $this->modelObject = $modelObject;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->modelObject->find($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return trans('validate.search_in_model');
    }
}
