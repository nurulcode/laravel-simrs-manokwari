<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $unique = Rule::unique('roles')->ignore(
            optional($this->route('role'))->id
        );

        return [
            'name'             => ['required', $unique],
            'description'      => ['required'],
            'permissions.*.id' => ['nullable', 'exists:permissions']
        ];
    }
}
