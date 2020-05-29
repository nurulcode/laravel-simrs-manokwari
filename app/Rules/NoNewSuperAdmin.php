<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoNewSuperAdmin implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $values)
    {
        return empty(array_where($values, function ($value, $key) {
            return $value['name'] == 'superadmin';
        }));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tidak dapat menambahkan role superadmin ke user.';
    }
}
