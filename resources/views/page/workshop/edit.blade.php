@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between px-5 pb-0">
            <h5 class="card-title">Edit Workshop</h5>
            <span class="badge bg-label-info">Status: {{ $data->ActivityStatusName }}</span>
        </div>
        <hr />
        <div class="card-body px-0 py-0">
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

            <div class="card">
                <div class="card-header px-0 pt-0">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tab-actualstart" aria-controls="navs-tab-actualstart"
                                    aria-selected="true">Edit
                                    Actual Start</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tab-actualfinish" aria-controls="navs-tab-actualfinish"
                                    aria-selected="true">Edit
                                    Actual Finish</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tab-planninginfo" aria-controls="navs-tab-planninginfo"
                                    aria-selected="false" tabindex="-1">Planning Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tab-progress" aria-controls="navs-tab-progress"
                                    aria-selected="false" tabindex="-1">Progress</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade active show" id="navs-tab-actualstart" role="tabpanel">
                            <form id="form-edit-start"action="{{ route('page.workshop.update', $data->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex gap-4 mb-3">
                                    <div class="">
                                        <label for="ActivityId" class="form-label">Activity Id</label>
                                        <input type="text" name="ActivityId" class="form-control"
                                            value="{{ old('ActivityId', $data->ActivityId) }}"
                                            oninput="this.value = this.value.toUpperCase()" disabled>
                                    </div>
                                    <div class="w-100">
                                        <label for="ActivityName" class="form-label">Activity Name</label>
                                        <input type="text" name="ActivityName" class="form-control"
                                            value="{{ old('ActivityName', $data->ActivityName) }}" disabled>
                                    </div>
                                    <div class="">
                                        <label for="wo_number" class="form-label">Wo Number</label>
                                        <input type="text" name="wo_number" class="form-control"
                                            value="{{ old('wo_number', $data->wo_number->wo_number) }}"
                                            oninput="this.value = this.value.toUpperCase()" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ActualStart" class="form-label">Actual Start</label>
                                    <input type="text" id="ActualStart" name="ActualStart" class="form-control"
                                        data-provider="flatpickr"
                                        value="{{ old('ActualStart', \Carbon\Carbon::parse($data->ActualStart)->format('d-M-y')) }}"
                                        required>
                                </div>

                                <div class="card-footer d-flex justify-content-between px-0">
                                    <div>
                                        <small class="text-secondary" style="white-space: pre-line;"
                                            id="infoactualstart"></small>
                                    </div>
                                    <div class="d-flex gap-4">
                                        <a href="{{ route('page.workshop.index') }}" class="btn btn-dark"><i
                                                class="icon-base bx bx-arrow-back icon-sm me-1"></i> Back to list</a>
                                        @if ($data->ActivityStatus == 0)
                                            <button type="submit" data-action="update" class="btn btn-primary"><i
                                                    class="icon-base bx bx-save icon-sm me-1"></i>
                                                Update Actual Start</button>
                                        @endif
                                        @if ($data->ActivityStatus == 1)
                                            <button type="submit" data-action="cancel" class="btn btn-danger"><i
                                                    class="icon-base bx bx-x icon-sm me-1"></i>
                                                Cancel Actual Start</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="navs-tab-actualfinish" role="tabpanel">
                            <form id="form-edit-finish" action="{{ route('page.workshop.update', $data->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex gap-4 mb-3">
                                    <div class="">
                                        <label for="ActivityId" class="form-label">Activity Id</label>
                                        <input type="text" name="ActivityId" class="form-control"
                                            value="{{ old('ActivityId', $data->ActivityId) }}"
                                            oninput="this.value = this.value.toUpperCase()" disabled>
                                    </div>
                                    <div class="w-100">
                                        <label for="ActivityName" class="form-label">Activity Name</label>
                                        <input type="text" name="ActivityName" class="form-control"
                                            value="{{ old('ActivityName', $data->ActivityName) }}" disabled>
                                    </div>
                                    <div class="">
                                        <label for="wo_number" class="form-label">Wo Number</label>
                                        <input type="text" name="wo_number" class="form-control"
                                            value="{{ old('wo_number', $data->wo_number->wo_number) }}"
                                            oninput="this.value = this.value.toUpperCase()" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ActualFinish" class="form-label">Actual Finish</label>
                                    <input type="text" id="ActualFinish" name="ActualFinish" class="form-control"
                                        data-provider="flatpickr"
                                        value="{{ old('ActualFinish', \Carbon\Carbon::parse($data->ActualFinish)->format('d-M-y')) }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="Holiday" class="form-label">Holiday</label>
                                    <input type="number" id="Holiday" name="Holiday" class="form-control"
                                        value="{{ old('Holiday', $data->Holiday) }}" required>

                                </div>
                                <div class="mb-3">
                                    <label for="ActualDuration" class="form-label">Actual Duration</label>
                                    <input type="number" id="ActualDuration" name="ActualDuration" class="form-control"
                                        value="{{ old('ActualDuration', $data->ActualDuration) }}" readonly>
                                    <small class="text-secondary">Actual Duration = Actual Finish - Actual Start -
                                        Holiday.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="Remarks" class="form-label">Remark</label>
                                    <textarea type="text" id="Remarks" name="Remarks" class="form-control">{{ old('Remarks', $data->Remarks) }}</textarea>
                                </div>
                                <div class="card-footer d-flex justify-content-between px-0">
                                    <div>
                                        <small class="text-secondary" style="white-space: pre-line;"
                                            id="infoactualfinish"></small>
                                    </div>
                                    <div class="d-flex gap-4">
                                        <a href="{{ route('page.workshop.index') }}" class="btn btn-dark"><i
                                                class="icon-base bx bx-arrow-back icon-sm me-1"></i> Back to list</a>

                                        @if ($data->ActivityStatus == 1)
                                            <button type="submit" data-action="update" class="btn btn-primary"><i
                                                    class="icon-base bx bx-save icon-sm me-1"></i>
                                                Update Actual Finish</button>
                                        @endif

                                        @if ($data->ActivityStatus == 2)
                                            <button type="submit" data-action="cancel" class="btn btn-danger"><i
                                                    class="icon-base bx bx-x icon-sm me-1"></i>
                                                Cancel Actual Finish</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="navs-tab-planninginfo" role="tabpanel">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pe-10">Activity Id</td>
                                        <td class="px-2">:</td>
                                        <td>{{ $data->ActivityId }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-10">Activity Name</td>
                                        <td class="px-2">:</td>
                                        <td>{{ $data->ActivityName }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-10">BL Project Start</td>
                                        <td class="px-2">:</td>
                                        <td>{{ \Carbon\Carbon::parse($data->BLProjectStart)->format('d-M-y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-10">BL Project Finish</td>
                                        <td class="px-2">:</td>
                                        <td>{{ \Carbon\Carbon::parse($data->BLProjectFinish)->format('d-M-y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-10">BL Duration</td>
                                        <td class="px-2">:</td>
                                        <td>{{ $data->BLDuration }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-10">Wo Number</td>
                                        <td class="px-2">:</td>
                                        <td>{{ $data->wo_number->wo_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-10">Department</td>
                                        <td class="px-2">:</td>
                                        <td>{{ $data->department->initial }} - {{ $data->department->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="navs-tab-progress" role="tabpanel">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="javascript:void(0);" class="btn btn-primary">Go profile</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $('.select2').select2();

            const startPicker = flatpickr("#ActualStart", {
                dateFormat: "d-M-y",
                defaultDate: "{{ \Carbon\Carbon::parse($data->ActualStart)->format('d-M-y') }}",
            });

            const endPicker = flatpickr("#ActualFinish", {
                dateFormat: "d-M-y",
                defaultDate: "{{ \Carbon\Carbon::parse($data->ActualFinish)->format('d-M-y') }}",
                onChange: calculateDuration
            });

            $("#Holiday").on("blur change", function() {
                let val = $(this).val();
                if (val === "") {
                    $(this).val(0);
                } else {
                    $(this).val(parseInt(val, 10));
                }

                calculateDuration();
            });


            function calculateDuration() {
                let startDate = startPicker.selectedDates[0];
                let endDate = endPicker.selectedDates[0];

                if (startDate && endDate) {
                    startDate = new Date(startDate.setHours(0, 0, 0, 0));
                    endDate = new Date(endDate.setHours(0, 0, 0, 0));

                    const diffTime = endDate - startDate;
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    const actualDuration = (diffDays > 0 ? diffDays : 0) - (parseInt($("#Holiday").val()) || 0);

                    $("#ActualDuration").val(actualDuration > 0 ? actualDuration : 0);
                } else {
                    $("#ActualDuration").val("");
                }
            }

            calculateDuration();

            if ({{ $data->ActivityStatus }} == 0) {
                $("#infoactualstart").text(
                    "* After the actual start is filled in, the status will become in progress.");
                $("#infoactualfinish").text(
                    "*Actual start is not filled in yet, please update actual start first.");
            } else if ({{ $data->ActivityStatus }} == 1) {
                $("#infoactualstart").text(
                    "* Actual start has been updated, cannot be updated again.\n* Click Cancel Actual Start to update again and status will be not started again."
                );
                $("#infoactualfinish").text(
                    "*After the actual finish is filled in, the status will become Completed.");
            } else if ({{ $data->ActivityStatus }} == 2) {
                $("#infoactualstart").text(
                    "* Activity has been completed, cannot be updated again."
                );
                $("#infoactualfinish").text(
                    "* Activity has been completed, cannot be updated again.\n* Click Cancel Actual Finish to cancel completed and status will be not in progress again."
                );
            } else {
                $("#infoactualstart").text("");
                $("#infoactualfinish").text("");
            }


        });


        document.addEventListener('DOMContentLoaded', function() {
            const formEditStart = document.getElementById('form-edit-start');
            if (formEditStart) {
                const submitButtons = formEditStart.querySelectorAll('button[type="submit"]');

                submitButtons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        formEditStart.dataset.submitType = this.dataset.action;
                    });
                });
                formEditStart.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let submitType = formEditStart.dataset.submitType;

                    let hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "action";
                    hiddenInput.value = (submitType == 'update' ? 'update_start' : 'cancel_start');
                    formEditStart.appendChild(hiddenInput);

                    Swal.fire({
                        title: `${(submitType == 'update') ? 'Update' : 'Cancel'} workshop actual start data?`,
                        text: `Data will be ${(submitType == 'update') ? 'updated' : 'cancelled'} in the system`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes!',
                        cancelButtonText: 'No!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formEditStart.submit();
                        }
                    });
                });
            }

            const formEditFinish = document.getElementById('form-edit-finish');
            if (formEditFinish) {
                const submitButtons = formEditFinish.querySelectorAll('button[type="submit"]');

                submitButtons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        formEditFinish.dataset.submitType = this.dataset.action;
                    });
                });
                formEditFinish.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let submitType = formEditFinish.dataset.submitType;

                    let hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "action";
                    hiddenInput.value = (submitType == 'update' ? 'update_finish' : 'cancel_finish');
                    formEditFinish.appendChild(hiddenInput);

                    Swal.fire({
                        title: `${(submitType == 'update') ? 'Update' : 'Cancel'} workshop actual finish data?`,
                        text: `Data will be ${(submitType == 'update') ? 'updated' : 'cancelled'} in the system`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes!',
                        cancelButtonText: 'No!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formEditFinish.submit();
                        }
                    });
                });
            }
        });
    </script>
@endpush
