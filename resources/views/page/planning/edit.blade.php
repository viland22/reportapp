@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">Edit Planning</h5>
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

            <form id="form-edit" action="{{ route('page.planning.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="d-flex gap-4 mb-3">
                    <div class="">
                        <label for="ActivityId" class="form-label">Activity Id</label>
                        <input type="text" name="ActivityId" class="form-control"
                            value="{{ old('ActivityId', $data->ActivityId) }}"
                            oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div class="w-100">
                        <label for="ActivityName" class="form-label">Activity Name</label>
                        <input type="text" name="ActivityName" class="form-control"
                            value="{{ old('ActivityName', $data->ActivityName) }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="BLProjectStart" class="form-label">BL Project Start</label>
                    <input type="text" id="BLProjectStart" name="BLProjectStart" class="form-control"
                        data-provider="flatpickr"
                        value="{{ old('BLProjectStart', \Carbon\Carbon::parse($data->BLProjectStart)->format('d-M-y')) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="BLProjectFinish" class="form-label">BL Project Finish</label>
                    <input type="text" id="BLProjectFinish" name="BLProjectFinish" class="form-control"
                        data-provider="flatpickr"
                        value="{{ old('BLProjectFinish', \Carbon\Carbon::parse($data->BLProjectFinish)->format('d-M-y')) }}"
                        required>
                </div>


                <div class="mb-3">
                    <label for="BLDuration" class="form-label">BL Duration</label>
                    <input type="number" id="BLDuration" name="BLDuration" class="form-control"
                        value="{{ old('BLDuration', $data->BLDuration) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="wo_number_id" class="form-label">Wo Number</label>
                    <select id="wo_number_id" name="wo_number_id" class="form-control form-select select2" required>
                        <option value="">-- Select Wo Number --</option>
                        @foreach ($wo_numbers as $wo_number)
                            <option value="{{ $wo_number->id }}"
                                {{ old('wo_number_id', $data->wo_number_id) == $wo_number->id ? 'selected' : '' }}>
                                {{ $wo_number->wo_number }}
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
                                {{ old('department_id', $data->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->initial }} - {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="card-footer d-flex justify-content-end gap-3">
                    <button type="submit" class="btn btn-primary"><i class="icon-base bx bx-save icon-sm me-1"></i>
                        Update</button>
                    <a href="{{ route('page.planning.index') }}" class="btn btn-danger"><i
                            class="icon-base bx bx-x icon-sm me-1"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $('.select2').select2();

            const startPicker = flatpickr("#BLProjectStart", {
                dateFormat: "d-M-y",
                defaultDate: "{{ \Carbon\Carbon::parse($data->BLProjectStart)->format('d-M-y') }}",
                onChange: calculateDuration
            });

            const endPicker = flatpickr("#BLProjectFinish", {
                dateFormat: "d-M-y",
                defaultDate: "{{ \Carbon\Carbon::parse($data->BLProjectFinish)->format('d-M-y') }}",
                onChange: calculateDuration
            });

            function calculateDuration() {
                let startDate = startPicker.selectedDates[0];
                let endDate = endPicker.selectedDates[0];

                if (startDate && endDate) {
                    startDate = new Date(startDate.setHours(0, 0, 0, 0));
                    endDate = new Date(endDate.setHours(0, 0, 0, 0));

                    const diffTime = endDate - startDate;
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    $("#BLDuration").val(diffDays > 0 ? diffDays : 0);
                } else {
                    $("#BLDuration").val("");
                }
            }

            $("#BLDuration").val("{{ $data->BLDuration }}");
        });


        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-edit');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Update planning data?',
                        text: "Data will be updated in the system",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, update!',
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
@endpush
