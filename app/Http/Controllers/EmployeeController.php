<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::all()
        ]);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index');
    }


}
