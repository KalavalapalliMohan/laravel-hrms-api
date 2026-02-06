<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    // public function index()
    // {
    //     return view('employees.index', [
    //         'employees' => Employee::all()
    //     ]);
    // }

    public function index()
    {
        $employees = Employee::latest()->paginate(2);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')
        ->with('success', 'Employee added successfully');
    }

    // ✅ EDIT
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // ✅ UPDATE
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employees.index');
    }

}
