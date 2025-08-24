@extends('layouts.dashboard')

@section('title', 'Workshop')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between px-5 pb-0">
            <h5 class="card-title">Workshop</h5>
            <div class="card-actions d-flex align-items-center gap-2">
                <span class="badge bg-danger">Not Started: {{ $statusCounts['not_started'] }}</span>
                <span class="badge bg-primary">In Progress: {{ $statusCounts['in_progress'] }}</span>
                <span class="badge bg-success">Completed: {{ $statusCounts['completed'] }}</span>
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
                        <th>Status</th>
                        <th>Activity Id</th>
                        <th>Activity Name</th>
                        <th>Wo Number</th>
                        <th>Actual Start</th>
                        <th>Actual Finish</th>
                        <th>Holiday</th>
                        <th>Actual Duration</th>
                        <th>Remarks</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $workshop)
                        <tr>
                            <td>
                                <a href="{{ route('page.workshop.edit', $workshop->id) }}" class="btn btn-sm btn-warning"
                                    title="Edit Workshop"><i class="icon-base bx bx-edit icon-sm"></i></a>
                            </td>
                            <td>{{ $workshop->ActivityStatusName ?? '-' }}</td>
                            <td>{{ $workshop->ActivityId }}</td>
                            <td>{{ $workshop->ActivityName }}</td>
                            <td>{{ $workshop->wo_number->wo_number ?? '-' }}</td>
                            <td>{{ ($workshop->ActualStart == null ? '' : \Carbon\Carbon::parse($workshop->ActualStart )->format('d-M-y')) }}</td>
                            <td>{{ ($workshop->ActualFinish == null ? '' : \Carbon\Carbon::parse($workshop->ActualFinish )->format('d-M-y')) }}</td>
                            <td>{{ $workshop->Holiday }}</td>
                            <td>{{ $workshop->ActualDuration }}</td>
                            <td>{{ $workshop->Remarks }}</td>
                            <td>{{ $workshop->department->initial ?? '-' }} - {{ $workshop->department->name ?? '-' }}
                            </td>
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
                        [2, "desc"],
                    ],
                    //dom: '<"row mx-1"<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>><"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"logtipe mb-3 mb-md-0">>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    dom: '<"row mx-1"' +
                        '<"col-12 col-md-6 d-flex align-items-center justify-content-md-start gap-3"l>' +
                        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"' +
                        'f<"logtipe mb-3 mb-md-0">B' +
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
                    initComplete: function() {
                        this.api().columns(1).every(function() {
                            var e = this,
                                t = $(
                                    '<select class="form-select form-select-sm"><option value=""> Status </option></select>'
                                ).appendTo(".logtipe").on("change", function() {
                                    var a = $.fn.dataTable.util.escapeRegex($(this).val());
                                    e.search(a ? "^" + a + "$" : "", !0, !1).draw()
                                });
                            e.data().unique().sort().each(function(a, e) {
                                t.append('<option value="' + a + '" class="text-capitalize">' +
                                    a + "</option>")
                            })
                        })
                    }
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

    </script>
@endpush
