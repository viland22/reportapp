@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">Add Department</h5>
        </div>
        <hr />
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger mx-2">
                    {{ session('error') }}
                </div>
            @endif
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

            <form id="form-create" action="{{ route('page.department.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="initial" class="form-label">Initial</label>
                    <input type="text" name="initial" class="form-control" value="{{ old('initial') }}"
                        oninput="this.value = this.value.toUpperCase()" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="card-footer d-flex justify-content-end gap-3">
                    <a href="{{ route('page.department.index') }}" class="btn btn-dark"><i
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
        document.getElementById('form-create').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Add department data?',
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
