<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index');
    }


    
    // ✅ EDIT
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employees.index');
    }

}
