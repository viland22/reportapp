@extends('layouts.dashboard')

@section('title', 'Department')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between px-5 pb-0">
            <h5 class="card-title">Master Department</h5>
            <div class="card-actions">
                <a href="{{ route('page.department.create') }}" class="btn btn-primary"><i
                        class="icon-base icon-16px bx bx-plus me-md-2"></i> <span class="d-md-inline-block d-none">Add
                        Department</span></a>
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
            <table class="table table-sm table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="width: 10px">Action</th>
                        <th>No</th>
                        <th>Initial</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $department)
                        <tr>
                            <td>
                                <a href="{{ route('page.department.edit', $department->id) }}"
                                    class="btn btn-sm btn-warning" title="Edit Department"><i
                                        class="icon-base bx bx-edit icon-sm"></i></a>
                                <form class="form-delete" action="{{ route('page.department.destroy', $department->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete Department"><i
                                            class="icon-base bx bx-trash icon-sm"></i></button>
                                </form>
                            </td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $department->initial }}</td>
                            <td>{{ $department->name }}</td>

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
                    responsive: !0,

                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "Search Log"
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
    </script>
@endpush
