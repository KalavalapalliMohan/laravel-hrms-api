<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        $data = $request->validated();
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employees', 'public');
            $data['photo'] = $path;
        }

        Employee::create($data);

        return redirect()->route('employees.index')
        ->with('success', 'Employee added successfully');
    }

    // ✅ EDIT
    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);
        return view('employees.edit', compact('employee'));
    }

    // ✅ UPDATE
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {

        $data = $request->validated();

        if ($request->hasFile('photo')) {

            if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
                    Storage::disk('public')->delete($employee->photo);
            }

            $data['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee->update($data);
        

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }

    // ✅ DELETE
    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);
        $employee->delete();
        return redirect()->route('employees.index');
    }

    use AuthorizesRequests;
}
