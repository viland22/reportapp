@extends('layouts.dashboard')

@section('title', 'Add User')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">Add User</h5>
        </div>
        <hr />
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger mx-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mx-2">{{ session('success') }}</div>
            @endif

            <form id="form-create" action="{{ route('page.user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required minlength="6">
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" class="form-select select2" required>
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select id="department_id" name="department_id" class="form-select select2" required>
                        <option value="">-- Select Department --</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->initial }} - {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="card-footer d-flex justify-content-end gap-3">
                    <a href="{{ route('page.user.index') }}" class="btn btn-dark"><i
                            class="icon-base bx bx-arrow-back icon-sm me-1"></i> Back to list</a>
                    <button type="submit" class="btn btn-primary"><i class="icon-base bx bx-save icon-sm me-1"></i>
                        Save</button>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2();
        });

        document.getElementById('form-create').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Add user data?',
                text: "Data will be added to the system",
                icon: 'question',
                theme: 'dark',
                showCancelButton: true,
                confirmButtonText: 'Yes, save!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endpush
