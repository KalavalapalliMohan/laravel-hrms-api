<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role->name === 'Admin'
            || auth()->user()->role->name === 'HR';
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|min:3',
            'email' => 'required|email|unique:employees,email,' . $this->employee->id,
            'phone' => 'required|digits:10',
            'designation' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Employee name is required',
            'email.unique'  => 'Email already exists',
            'phone.digits'  => 'Phone must be 10 digits',
        ];
    }
}
