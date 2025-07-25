@extends('layouts.master')
@section('page')
<div class="container py-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-3 shadow-sm">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">LeaveApplication List</h3>
                <a href="{{ route('leave_applications.create') }}" class="btn btn-light btn-sm shadow-sm" title="Create New Product">
                    <i class="fa fa-plus mr-1"></i> Create New LeaveApplication
                </a>
            </div>
        </div>
    </div>
    <!-- Filter Section -->
    <div class="card mb-3 p-4 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="form-row">
                    <!-- Search Input with Icon -->
                    <div class="col-md-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text px-2 bg-primary text-white">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="search" placeholder="Search product by name">
                        </div>
                    </div>

                    <!-- Filter by Category -->
                    <div class="col-md-3">
                        <select class="form-control" id="filterCategory">
                            <option value="">Filter by Category</option>
                            <option value="">option-1</option>
                            <option value="">option-2</option>
                            <option value="">option-3</option>
                            <option value="">option-4</option>
                        </select>
                    </div>

                    <!-- Apply Filters Button -->
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block">Apply Filters</button>
                    </div>

                    <!-- Reset Filters Button -->
                    <div class="col-md-2">
                        <button class="btn btn-outline-danger btn-block">Reset Filters</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end filter section -->

    <!-- Table section -->
    <div class="card shadow-sm">
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered text center">
                <thead class="thead-dark"><tr><th>Id</th><th>Created at</th><th>Person id</th><th>Reason id</th><th>Remark</th><th>From date</th><th>To date</th><th>Status id</th><th>Category id</th><th>Days</th><th>Actions</th></tr></thead>
                <tbody>
                @foreach ($leave_applications as $item)
                    <tr><td>{{ $item->id }}</td><td>{{ $item->created_at }}</td><td>{{ optional($item->person)->name ?? $item->person_id }}</td><td>{{ optional($item->reason)->name ?? $item->reason_id }}</td><td>{{ $item->remark }}</td><td>{{ $item->from_date }}</td><td>{{ $item->to_date }}</td><td>{{ optional($item->status)->name ?? $item->status_id }}</td><td>{{ optional($item->category)->name ?? $item->category_id }}</td><td>{{ $item->days }}</td><td>
    <a href="{{ route('leave_applications.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
    <a href="{{ route('leave_applications.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('leave_applications.destroy', $item->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</td></tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End table section -->
</div>
@endsection