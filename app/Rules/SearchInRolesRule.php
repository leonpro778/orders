<?php


namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;

class SearchInRolesRule implements Rule
{
    private $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
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
        return $this->roles->find($value);
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
