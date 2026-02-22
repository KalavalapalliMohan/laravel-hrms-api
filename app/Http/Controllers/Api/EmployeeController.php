<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\Api\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;


class EmployeeController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $this->authorize('viewAny', Employee::class);
        return EmployeeResource::collection(Employee::paginate(10));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create', Employee::class);
        return new EmployeeResource(
            Employee::create($request->validated())
        );
    }

    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update', $employee);
        $employee->update($request->all());
        return response()->json(['message' => 'Employee updated']);
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted']);
    }



}
