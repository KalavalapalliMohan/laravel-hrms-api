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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">

                        <h3 class="mb-4">Add Employee</h3>

                        <form action="{{ route('employees.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" value="{{ old('phone') }}">
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">
                                @error('designation') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>






