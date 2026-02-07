<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth()->user()->role->name === 'Admin')
                Admin Dashboard
            @elseif(auth()->user()->role->name === 'HR')
                HR Dashboard
            @else
                Dashboard
            @endif
        </h2>

    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- <div class="container mt-5"> -->

                        <div class="d-flex justify-content-between mb-3">
                            <h3>Employees List</h3>
                            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                + Add Employee
                            </a>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('storage/'.$employee->photo) }}" width="50"></td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->designation }}</td>
                                    <td>
                                        <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ route('employees.destroy',$employee->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No employees found</td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                        <div class="d-flex justify-content-between mt-0">
                            {{ $employees->links() }}
                        </div>

                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

