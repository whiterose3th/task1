<?php

namespace App\Http\Requests;

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
        // Only allow updates if the user is logged in and authorized
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Unique validation for name, but allow updates if name is unchanged
        return [
            'name' => 'required|string|min:3|max:255|unique:roles,name,' . $this->route('role'),
            'permissions' => 'required|array', // Permissions must be an array
            'permissions.*' => 'exists:permissions,id', // Each permission must exist in the permissions table
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'role name',
            'permissions' => 'permissions',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The role name is required.',
            'name.unique' => 'The role name must be unique. This name is already in use.',
            'name.min' => 'The role name must be at least 3 characters.',
            'permissions.required' => 'Please select at least one permission for this role.',
            'permissions.*.exists' => 'One or more selected permissions are invalid.',
        ];
    }
}
