@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">Edit Department</h5>
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

            <form id="form-edit" action="{{ route('page.department.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Initial</label>
                    <input type="text" name="initial" class="form-control" value="{{ old('initial', $data->initial) }}"
                        oninput="this.value = this.value.toUpperCase()" required>
                </div>

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $data->name) }}"
                        required>
                </div>
                <div class="card-footer d-flex justify-content-end gap-3">
                    <a href="{{ route('page.department.index') }}" class="btn btn-dark"><i
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
            const form = document.getElementById('form-edit');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Update department data?',
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
