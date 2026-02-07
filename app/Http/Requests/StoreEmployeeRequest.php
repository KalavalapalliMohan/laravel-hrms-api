<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
        // return auth()->user()->role->name === 'Admin'
        //     || auth()->user()->role->name === 'HR';

    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|digits:10',
            'designation' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }

     public function messages()
    {
        return [
            'name.required' => 'Employee name is required',
            'name.min' => 'Employee name must be at least 3 characters',

            'email.required' => 'Email is mandatory',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email already exists',

            'phone.required' => 'Phone number is required',
            'phone.digits' => 'Phone number must be 10 digits',

            'designation.required' => 'Designation is required',
            
            'photo.required' => 'photo is required',
        ];
    }

}
