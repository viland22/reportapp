@extends('layouts.dashboard')

@section('title', 'Planning')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between px-5 pb-0">
            <h5 class="card-title">Planning</h5>
            <div class="card-actions">
                <a href="{{ route('page.planning.create') }}" class="btn btn-primary"><i
                        class="icon-base icon-16px bx bx-plus me-md-2"></i> <span class="d-md-inline-block d-none">Add
                        Planning</span></a>
            </div>
        </div>
        <hr />
        @if (session('success'))
            <div class="alert alert-success mx-2">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mx-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-datatable text-nowrap table-responsive">
            <table class="table table-sm table-striped table-hover table-responsive text-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">Action</th>
                        <th>Activity Id</th>
                        <th>Activity Name</th>
                        <th>Wo Number</th>
                        <th>BL Project Start</th>
                        <th>BL Project Finish</th>
                        <th>BL Holiday</th>
                        <th>BL Duration</th>
                        {{-- <th>Actual Start</th>
                        <th>Actual Finish</th>
                        <th>Actual Duration</th> --}}
                        <th>Department</th>
                        {{-- <th>Remarks</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $planning)
                        <tr>
                            <td>
                                <a href="{{ route('page.planning.edit', $planning->id) }}" class="btn btn-sm btn-warning"
                                    title="Edit Planning"><i class="icon-base bx bx-edit icon-sm"></i></a>
                                <form class="form-delete" data-activity="{{ $planning->ActivityName }}"
                                    data-status="{{ $planning->ActivityStatus }}"
                                    action="{{ route('page.planning.destroy', $planning->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete Planning"><i
                                            class="icon-base bx bx-trash icon-sm"></i></button>
                                </form>
                            </td>
                            <td>{{ $planning->ActivityId }}</td>
                            <td>{{ $planning->ActivityName }}</td>
                            <td>{{ $planning->wo_number->wo_number ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($planning->BLProjectStart )->format('d-M-y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($planning->BLProjectFinish )->format('d-M-y') }}</td>
                            <td>{{ $planning->BLHoliday }}</td>
                            <td>{{ $planning->BLDuration }}</td>
                            {{-- <td>{{ $planning->ActualStart }}</td>
                            <td>{{ $planning->ActualFinish }}</td>
                            <td>{{ $planning->ActualDuration }}</td> --}}
                            <td>{{ $planning->department->initial ?? '-' }} - {{ $planning->department->name ?? '-' }}
                            </td>
                            {{-- <td>{{ $planning->remarks }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            setDatatable();
        });

        function setDatatable() {
            var a, e = $("table");
            e.length && (a = e.DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    columnDefs: [{
                        targets: 0,
                        title: "Actions",
                        searchable: !1,
                        orderable: !1,
                    }],
                    order: [
                        [1, "asc"],
                    ],
                    dom: '<"row mx-1"' +
                        '<"col-12 col-md-6 d-flex align-items-center justify-content-md-start gap-3"l>' +
                        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"' +
                        'fB' +
                        '>' +
                        '>t' +
                        '<"row mx-2"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>',
                    //responsive: !0,

                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "Search ..."
                    },
                    buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-sm btn-success',
                        exportOptions: {
                            columns: ':not(:first-child)'
                        }
                    }],

                })),
                e.on("draw.dt", function() {
                    [].slice.call(document.queryselectorall('[data-bs-toggle="tooltip"]')).map(function(a) {
                        return new bootstrap.tooltip(a, {
                            boundary: document.body
                        })
                    })
                }),
                setTimeout(() => {
                    $(".dataTables_filter .form-control").addClass("form-control-sm"),
                        $(".dataTables_length .form-select").addClass("form-select-sm")
                }, 300)

        }

        document.querySelectorAll('.form-delete').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let activityName = form.dataset.activity;
                let actvityStatus = form.dataset.status;

                if (actvityStatus == 0) {
                    Swal.fire({
                        title: 'Delete planning data?',
                        text: `Data "${activityName}" will be removed from the list`,
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
                } else {
                    Swal.fire({
                        title: 'Cannot delete planning data',
                        text: `Data activity "${activityName}" is in progress!`,
                        icon: 'error',
                        theme: 'dark',
                        confirmButtonText: 'Ok',
                    });
                }

            });
        });
    </script>
@endpush
