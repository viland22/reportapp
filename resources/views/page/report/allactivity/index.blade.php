@extends('layouts.dashboard')

@section('title', 'Report All Activity')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between px-5 pb-0">
            <h5 class="card-title">Report All Activity</h5>
        </div>
        <hr />

        <div class="card-datatable text-nowrap table-responsive">
            <table class="table table-sm table-striped table-hover table-responsive text-sm" style="font-size: small">
                <thead>
                    <tr>
                        <th></th>
                        <th style="font-size: smaller; font-weight:bold">Activity Id</th>
                        <th style="font-size: smaller; font-weight:bold">Activity Name</th>
                        <th style="font-size: smaller; font-weight:bold">Wo Number</th>
                        <th style="font-size: smaller; font-weight:bold">Department</th>
                        <th style="font-size: smaller; font-weight:bold">Status</th>
                        <th style="font-size: smaller; font-weight:bold">Progress %</th>
                        <th style="font-size: smaller; font-weight:bold">BL Project Start</th>
                        <th style="font-size: smaller; font-weight:bold">BL Project Finish</th>
                        <th style="font-size: smaller; font-weight:bold">BL Holiday</th>
                        <th style="font-size: smaller; font-weight:bold">BL Duration</th>
                        <th style="font-size: smaller; font-weight:bold">Actual Start</th>
                        <th style="font-size: smaller; font-weight:bold">Actual Finish</th>
                        <th style="font-size: smaller; font-weight:bold">Actual Holiday</th>
                        <th style="font-size: smaller; font-weight:bold">Actual Duration</th>
                        <th style="font-size: smaller; font-weight:bold">Remark Start</th>
                        <th style="font-size: smaller; font-weight:bold">Remark Finish</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $planning)
                        <tr>
                            <td>
                                <a href="{{ route('page.report.allactivity.view', $planning->id) }}"
                                    class="btn btn-sm btn-outline-secondary" title="View Activity"><i
                                        class="icon-base bx bx-show icon-sm"></i></a>
                            </td>
                            <td>{{ $planning->ActivityId }}</td>
                            <td>{{ $planning->ActivityName }}</td>
                            <td>{{ $planning->wo_number->wo_number ?? '-' }}</td>
                            <td>{{ $planning->department->initial ?? '-' }} - {{ $planning->department->name ?? '-' }}</td>
                            <td
                                class="{{ $planning->ActivityStatus === 0 ? 'text-danger' : ($planning->ActivityStatus === 1 ? 'text-warning' : 'text-success') }}">
                                {{ $planning->ActivityStatusName ?? '-' }}</td>
                            <td class="text-center">{{ $planning->ProgressPercent ?? '0' }}%</td>
                            <td>{{ \Carbon\Carbon::parse($planning->BLProjectStart)->format('d-M-y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($planning->BLProjectFinish)->format('d-M-y') }}</td>
                            <td class="text-center">{{ $planning->BLHoliday }}</td>
                            <td class="text-center">{{ $planning->BLDuration }}</td>
                            <td>{{ $planning->ActualStart }}</td>
                            <td>{{ $planning->ActualFinish }}</td>
                            <td class="text-center">{{ $planning->ActualHoliday }}</td>
                            <td class="text-center">{{ $planning->ActualDuration }}</td>
                            <td>{{ $planning->RemarkStart }}</td>
                            <td>{{ $planning->RemarkFinish }}</td>
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
                    order: [
                        [1, "desc"],
                    ],
                    columnDefs: [{
                        targets: 0,
                        title: "View",
                        searchable: !1,
                        orderable: !1,
                    }],
                    //dom: '<"row mx-1"<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>><"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"logtipe mb-3 mb-md-0">>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    dom: '<"row mx-1"' +
                        '<"col-12 col-md-4 d-flex align-items-center justify-content-md-start gap-3"l>' +
                        '<"col-12 col-md-8 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"' +
                        'f<"wono mb-3 mb-md-0"><"department mb-3 mb-md-0"><"logtipe mb-3 mb-md-0">B' +
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
                        const api = this.api();

                        // daftar konfigurasi: [index_kolom, target_class, label_placeholder]
                        const filters = [{
                                col: 3,
                                target: ".wono",
                                label: "Wo Number"
                            },
                            {
                                col: 4,
                                target: ".department",
                                label: "Department"
                            },
                            {
                                col: 5,
                                target: ".logtipe",
                                label: "Status"
                            }
                        ];

                        filters.forEach(f => {
                            const column = api.column(f.col);

                            // buat select element
                            const select = $(
                                    '<select class="form-select form-select-sm"><option value="">' + f
                                    .label + '</option></select>')
                                .appendTo(f.target)
                                .on("change", function() {
                                    const val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? "^" + val + "$" : "", true, false).draw();
                                });

                            // isi option berdasarkan data unik
                            column.data().unique().sort().each(function(d) {
                                select.append('<option value="' + d +
                                    '" class="text-capitalize">' + d + "</option>");
                            });
                        });
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
