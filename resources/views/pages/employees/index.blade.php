@extends('layouts.master')

@section('page')
    <div class="container py-4">

        <!-- Page Header -->
        <div class="card bg-primary text-white mb-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="m-0"><i class="fa fa-users me-2"></i>Employee List</h4>
                <a href="{{ route('employees.create') }}" class="btn btn-light btn-sm shadow-sm"
                    title="Create New Employee">
                    <i class="fa fa-plus me-1"></i> Create New Employee
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="search" placeholder="Search employee by name">
                        </div>
                    </div>

                    <!-- Filter by Category -->
                    <div class="col-md-3">
                        <select class="form-select" id="filterCategory">
                            <option value="">Filter by Category</option>
                            <option value="1">option-1</option>
                            <option value="2">option-2</option>
                            <option value="3">option-3</option>
                            <option value="4">option-4</option>
                        </select>
                    </div>

                    <!-- Apply Filter -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </div>

                    <!-- Reset -->
                    <div class="col-md-2">
                        <button type="reset" class="btn btn-outline-danger w-100">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Employee Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <!-- <th>Category</th> -->
                                <th>Photo</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <!-- <th>Phone</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <!-- <td>{{ optional($item->category)->name ?? $item->category_id }}</td> -->
                                    <td>
                                        @if($item->photo)
                                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Photo" width="50"
                                                class="rounded-circle">
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($item->salary, 2) }}</td>
                                    <!-- <td>{{ $item->phone }}</td> -->
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('employees.show', $item->id) }}"
                                                class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('employees.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('employees.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No employees found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $employees->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection