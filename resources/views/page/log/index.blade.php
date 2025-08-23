@extends('layouts.dashboard')

@section('title', 'Log History')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between px-5 pb-0">
            <h5 class="card-title">Log History</h5>
        </div>
        <hr />

        <div class="card-datatable text-nowrap table-responsive">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Model</th>
                        <th>Model ID</th>
                        <th>Message</th>
                        <th>Data</th>
                        <th>URL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{-- <span
                                    class="badge w-100 {{ $log->tipe === 'error' ? 'bg-label-danger' : 'bg-label-success' }}">
                                    {{ $log->tipe }}
                                </span> --}}
                                {{ $log->tipe }}
                            </td>
                            <td>{{ $log->created_at }}</td>
                            <td>{{ $log->user->name ?? '-' }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->model }}</td>
                            <td>{{ $log->model_id }}</td>
                            <td>{{ $log->message }}</td>
                            <td>
                                {{-- <pre>{{ json_encode($log->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre> --}}
                                <pre>{{ json_encode($log->data) }}</pre>
                            </td>
                            <td>{{ $log->url }}</td>
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
                    // columnDefs: [{
                    //     targets: -1,
                    //     title: "Actions",
                    //     searchable: !1,
                    //     orderable: !1,
                    // }],
                    order: [
                        [0, "desc"],
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
                    responsive: !0,

                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "Search ..."
                    },
                    buttons: [

                        {
                            extend: 'excelHtml5',
                            text: 'Export Excel',
                            className: 'btn btn-sm btn-success'
                        }
                    ],


                    initComplete: function() {
                        this.api().columns(1).every(function() {
                            var e = this,
                                t = $(
                                    '<select class="form-select form-select-sm"><option value=""> Log Type </option></select>'
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
