@extends('layouts.dashboard')

@section('title', 'Edit Workshop')

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
                                    data-bs-target="#navs-tab-upload" aria-controls="navs-tab-upload" aria-selected="false"
                                    tabindex="-1">Upload Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tab-progress" aria-controls="navs-tab-progress"
                                    aria-selected="false" tabindex="-1">Progress</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tab-planninginfo" aria-controls="navs-tab-planninginfo"
                                    aria-selected="false" tabindex="-1">Planning Info</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade active show" id="navs-tab-actualstart" role="tabpanel">
                            <div class="bg-lighter rounded p-4 position-relative mb-2">
                                <form id="form-edit-start" action="{{ route('page.workshop.update', $data->id) }}"
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

                                    <div class="mb-3">
                                        <label for="RemarkStart" class="form-label">Remark Start</label>
                                        <textarea type="text" id="RemarkStart" name="RemarkStart" class="form-control">{{ old('RemarkStart', $data->RemarkStart) }}</textarea>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between px-0">
                                        <div>
                                            <small class="text-secondary" style="white-space: pre-line;"
                                                id="infoactualstart"></small>
                                        </div>
                                        <div class="d-flex gap-4">
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
                        </div>
                        <div class="tab-pane fade" id="navs-tab-actualfinish" role="tabpanel">
                            <div class="bg-lighter rounded p-4 position-relative mb-2">
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
                                    @if ($data->ActualStart != null)
                                        <div class="mb-3">
                                            <label for="ActualStart" class="form-label">Actual Start</label>
                                            <input type="text" class="form-control" data-provider="flatpickr"
                                                value="{{ old('ActualStart', \Carbon\Carbon::parse($data->ActualStart)->format('d-M-y')) }}"
                                                disabled>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="ActualFinish" class="form-label">Actual Finish</label>
                                        <input type="text" id="ActualFinish" name="ActualFinish" class="form-control"
                                            data-provider="flatpickr"
                                            value="{{ old('ActualFinish', \Carbon\Carbon::parse($data->ActualFinish)->format('d-M-y')) }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ActualHoliday" class="form-label">Actual Holiday</label>
                                        <input type="number" id="ActualHoliday" name="ActualHoliday"
                                            class="form-control" value="{{ old('ActualHoliday', $data->ActualHoliday) }}"
                                            required>

                                    </div>
                                    <div class="mb-3">
                                        <label for="ActualDuration" class="form-label">Actual Duration</label>
                                        <input type="number" id="ActualDuration" name="ActualDuration"
                                            class="form-control"
                                            value="{{ old('ActualDuration', $data->ActualDuration) }}" readonly>
                                        <small class="text-secondary">Actual Duration = Actual Finish - Actual Start -
                                            Actual Holiday.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="RemarkFinish" class="form-label">Remark Finish</label>
                                        <textarea type="text" id="RemarkFinish" name="RemarkFinish" class="form-control">{{ old('RemarkFinish', $data->RemarkFinish) }}</textarea>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between px-0">
                                        <div>
                                            <small class="text-secondary" style="white-space: pre-line;"
                                                id="infoactualfinish"></small>
                                        </div>
                                        <div class="d-flex gap-4">

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
                        </div>
                        <div class="tab-pane fade" id="navs-tab-upload" role="tabpanel">
                            <form id="form-upload" action="{{ route('page.workshop.uploadImage', $data->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex gap-2 mb-3">
                                    <input type="file" class="form-control" id="images" name="images[]"
                                        accept="image/*" multiple required>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="icon-base bx bx-images icon-sm me-1"></i> Upload</button>
                                </div>
                            </form>
                            <div class="bg-lighter rounded p-4 position-relative mb-2">
                                @if ($images->isEmpty())
                                    <div class="bg-lighter rounded p-4 position-relative mb-2">
                                        <p class="text-center">No images uploaded for this workshop.</p>
                                    </div>
                                @endif
                                <div class="row">
                                    @foreach ($images as $imagesdata)
                                        <div class="col-4 col-md-2 mb-4">
                                            <div class="bg-light rounded overflow-hidden"
                                                style="aspect-ratio: 1/1; cursor: pointer;">
                                                <img src="{{ asset('storage/workshop/' . $imagesdata->filename) }}"
                                                    alt="Workshop Image" class="img-fluid gallery-image"
                                                    style="width: 100%; height: 100%; object-fit: cover;"
                                                    data-src="{{ asset('storage/workshop/' . $imagesdata->filename) }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Popup overlay --}}
                                <div id="imagePopup" class="popup-overlay d-none">
                                    <span class="popup-close">&times;</span>
                                    <img class="popup-content" id="popupImage" src="">
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-tab-progress" role="tabpanel">
                            <form id="form-add-progress" action="{{ route('page.workshop.storeProgress', $data->id) }}"
                                method="POST">
                                @csrf
                                <div class="d-flex gap-4 w-100 mb-4">
                                    <div class="">
                                        <label for="ProgressDate" class="form-label">Date</label>
                                        <input type="text" id="ProgressDate" name="ProgressDate" class="form-control"
                                            data-provider="flatpickr" required>
                                    </div>
                                    <div class="">
                                        <label for="ProgressPercent" class="form-label">Percent</label>
                                        <input type="number" id="ProgressPercent" name="ProgressPercent"
                                            class="form-control" value="0">
                                    </div>
                                    <div class="w-50">
                                        <label for="ProgressNote" class="form-label">Note</label>
                                        <input type="text" name="ProgressNote" class="form-control">
                                    </div>
                                    <div class="mt-auto">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="icon-base icon-16px bx bx-plus me-md-2"></i>Add Progress</button>
                                    </div>
                                </div>
                            </form>
                            <div class="bg-lighter rounded p-4 position-relative">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Percent</th>
                                            <th>Note</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    @foreach ($progress as $progressdata)
                                        <tr>
                                            <td style="width: 10%">
                                                {{ \Carbon\Carbon::parse($progressdata->ProgressDate)->format('d-M-y') }}
                                            </td>
                                            <td class="text-center" style="width: 10%">
                                                {{ $progressdata->ProgressPercent }} %
                                            </td>
                                            <td style="width: 75%">{{ $progressdata->ProgressNote }}</td>
                                            <td style="width: 5%">
                                                @if (!in_array($progressdata->ProgressPercent, [0, 100]))
                                                    <form class="form-delete-progress"
                                                        action="{{ route('page.workshop.destroyProgress', $progressdata->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Delete Progress"><i
                                                                class="icon-base bx bx-trash icon-sm"></i></button>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-tab-planninginfo" role="tabpanel">
                            <div class="row">
                                <div class="bg-lighter rounded p-4 mb-6 position-relative">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Activity Id</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->ActivityId }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Activity Name</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->ActivityName }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Wo Number</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->wo_number->wo_number }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Department</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->department->initial }} - {{ $data->department->name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bg-lighter rounded p-4 mb-6 position-relative">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">BL Project Start</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ \Carbon\Carbon::parse($data->BLProjectStart)->format('d-M-y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">BL Project Finish</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ \Carbon\Carbon::parse($data->BLProjectFinish)->format('d-M-y') }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 200px">BL Holiday</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->BLHoliday }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">BL Duration</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->BLDuration }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bg-lighter rounded p-4 position-relative">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Actual Start</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $data->ActualStart ? \Carbon\Carbon::parse($data->ActualStart)->format('d-M-y') : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px" style="vertical-align: top;">Remark Start</td>
                                                <td style="width: 10px" style="vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">
                                                    {{ trim($data->RemarkStart) }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 200px">Actual Finish</td>
                                                <td style="width: 20px">:</td>
                                                <td style="vertical-align: top;">
                                                    {{ $data->ActualFinish ? \Carbon\Carbon::parse($data->ActualFinish)->format('d-M-y') : '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px" style="vertical-align: top;">Remark Finish</td>
                                                <td style="width: 10px" style="vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">
                                                    {{ $data->RemarkFinish }}</td>
                                            </tr>

                                            <tr>
                                                <td style="width: 200px">Actual Holiday</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->ActualHoliday }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Actual Duration</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $data->ActualDuration }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('page.workshop.index') }}" class="btn btn-dark"><i
                            class="icon-base bx bx-arrow-back icon-sm me-1"></i> Back to list</a>
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

            $("#ActualHoliday").on("blur change", function() {
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

                    const actualDuration = (diffDays > 0 ? diffDays : 0) - (parseInt($("#ActualHoliday").val()) ||
                        0);

                    $("#ActualDuration").val(actualDuration > 0 ? actualDuration : 0);
                } else {
                    $("#ActualDuration").val("0");
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

            flatpickr("#ProgressDate", {
                dateFormat: "d-M-y",
                defaultDate: new Date(),
            });

            $("#ProgressPercent").on("blur change", function() {
                let val = $(this).val();
                if (val === "") {
                    $(this).val(0);
                } else {
                    $(this).val(parseInt(val, 10));
                }

            });

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

            const formAddProgress = document.getElementById('form-add-progress');
            formAddProgress.addEventListener('submit', function(e) {
                e.preventDefault();

                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "ActivityId";
                hiddenInput.value = "{{ $data->ActivityId }}";
                formAddProgress.appendChild(hiddenInput);

                Swal.fire({
                    title: 'Add progress activity data?',
                    text: "Data will be added to the system",
                    icon: 'question',
                    theme: 'dark',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Add progress!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formAddProgress.submit();
                    }
                });
            });

            const formUpload = document.getElementById('form-upload');
            formUpload.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Upload image data?',
                    text: "Image will be uploaded to the system",
                    icon: 'question',
                    theme: 'dark',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Upload image!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formUpload.submit();
                    }
                });
            });

            document.querySelectorAll('.form-delete-progress').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete progress data?',
                        text: `Data progress will be removed from the list`,
                        icon: 'question',
                        theme: 'dark',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });
            });

        });

        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.gallery-image');
            const popup = document.getElementById('imagePopup');
            const popupImg = document.getElementById('popupImage');
            const popupClose = document.querySelector('.popup-close');

            images.forEach(img => {
                img.addEventListener('click', function() {
                    popupImg.src = this.dataset.src;
                    popup.classList.remove('d-none');
                });
            });

            popupClose.addEventListener('click', function() {
                popup.classList.add('d-none');
                popupImg.src = '';
            });

            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    popup.classList.add('d-none');
                    popupImg.src = '';
                }
            });
        });
    </script>
@endpush
