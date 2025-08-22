@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">Add Planning</h5>
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

            <form id="form-create" action="{{ route('page.planning.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <label for="ActivityId" class="form-label">Activity Id</label>
                        <input type="text" name="ActivityId" class="form-control" value="{{ old('ActivityId') }}"
                            oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div class="col-md-9 mb-3">
                        <label for="ActivityName" class="form-label">Activity Name</label>
                        <input type="text" name="ActivityName" class="form-control" value="{{ old('ActivityName') }}"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <label for="WoNumber" class="form-label">Wo Number</label>
                        <input type="text" name="WoNumber" class="form-control" value="{{ old('WoNumber') }}"
                            oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <label for="BLProjectStart" class="form-label">BL Project Start</label>
                        <input type="text" name="BLProjectStart" class="form-control" value="{{ old('BLProjectStart') }}"
                            placeholder="YYYY-MM-DD" oninput="this.value = this.value.toUpperCase()" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="BLProjectFinish" class="form-label">BL Project Finish</label>
                        <input type="text" name="BLProjectFinish" class="form-control"
                            value="{{ old('BLProjectFinish') }}" placeholder="YYYY-MM-DD"
                            oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="Department" class="form-label">Department</label>
                        <input type="text" name="Department" class="form-control" value="{{ old('Department') }}"
                            oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-3">
                    <button type="submit" class="btn btn-primary"><i class="icon-base bx bx-save icon-sm me-1"></i>
                        Save</button>
                    <a href="{{ route('page.planning.index') }}" class="btn btn-danger"><i
                            class="icon-base bx bx-x icon-sm me-1"></i> Cancel</a>
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
                title: 'Add planning data?',
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
