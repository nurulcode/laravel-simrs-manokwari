<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class ArrayExists implements Rule
{
    protected $table;
    protected $key;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $key = 'id')
    {
        $this->table = $table;
        $this->key   = $key;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $table = $this->table;
        $key   = $this->key;

        return empty(array_where($value, function ($item) use ($table, $key) {
            return DB::table($table)
                ->where($key, $item[$key])
                ->doesntExist();
        }));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.exists');
    }
}
