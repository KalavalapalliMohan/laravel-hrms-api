<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Employee::paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
        ]);

        $employee = Employee::create($data);

        return response()->json([
            'message' => 'Employee created',
            'data' => $employee
        ], 201);
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return response()->json(['message' => 'Employee updated']);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Employee deleted']);
    }



}
