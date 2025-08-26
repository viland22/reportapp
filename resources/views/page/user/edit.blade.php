@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">Edit User</h5>
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

            <form id="form-edit" action="{{ route('page.user.update', $userSelected->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $userSelected->email) }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $userSelected->name) }}">
                </div>

                <div class="mb-3">
                    <label>Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control" autocomplete="password">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" class="form-select select2" required>
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $userSelected->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select id="department_id" name="department_id" class="form-control form-select select2" required>
                        <option value="">-- Select Department --</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id', $userSelected->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->initial }} - {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="card-footer d-flex justify-content-end gap-3">
                    <a href="{{ route('page.user.index') }}" class="btn btn-dark"><i
                            class="icon-base bx bx-arrow-back icon-sm me-1"></i> Back to list</a>
                    <button type="submit" class="btn btn-primary"><i class="icon-base bx bx-save icon-sm me-1"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-edit');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Update user data?',
                        text: "Data will be updated in the system",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, save!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
@endsection
