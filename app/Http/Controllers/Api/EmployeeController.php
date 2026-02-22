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

    public function index(Request $request)
    {
        $this->authorize('viewAny', Employee::class);

        $employees = Employee::query()

            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            })

            ->when($request->designation, function ($q) use ($request) {
                $q->where('designation', $request->designation);
            })

            ->when($request->sort === 'latest', function ($q) {
                $q->latest();
            })

            ->when($request->sort === 'oldest', function ($q) {
                $q->oldest();
            })

            ->paginate(10);

        return EmployeeResource::collection($employees);
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
