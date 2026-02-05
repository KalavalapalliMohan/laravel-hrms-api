<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

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

</div>

</body>
</html>
