@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i
                                    class="icon-base bx bx-error-circle icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $statusCounts['not_started'] }}</h4>
                        <small class="mb-2 ms-2">Activity</small>
                    </div>
                    <h5 class="mb-2">Not Started</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="icon-base bx bx-time icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $statusCounts['in_progress'] }}</h4>
                        <small class="mb-2 ms-2">Activity</small>
                    </div>
                    <h5 class="mb-2">In Progress</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i
                                    class="icon-base bx bx-check-circle icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $statusCounts['completed'] }}</h4>
                        <small class="mb-2 ms-2">Activity</small>
                    </div>
                    <h5 class="mb-2">Completed</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-info"><i
                                    class="icon-base bx bx-layer icon-lg"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $total }}</h4>
                        <small class="mb-2 ms-2">Activity</small>
                    </div>
                    <h5 class="mb-2">Total</h5>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->
        <!-- Activity overview -->
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Activity Overview</h5>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="d-none d-lg-flex vehicles-progress-labels mb-2">
                        <div class="vehicles-progress-label on-the-way-text"
                            style="width: {{ $percentages['not_started'] }}%;">Not Started</div>
                        <div class="vehicles-progress-label unloading-text"
                            style="width: {{ $percentages['in_progress'] }}%;">In Progress</div>
                        <div class="vehicles-progress-label loading-text" style="width: {{ $percentages['completed'] }}%;">
                            Completed</div>
                    </div> --}}
                    <div class="vehicles-overview-progress progress rounded-3 mb-6 bg-transparent overflow-hidden"
                        style="height: 46px;">
                        <div class="progress-bar fw-medium text-start shadow-none bg-danger text-heading px-4 rounded-0"
                            role="progressbar" style="width: {{ $percentages['not_started'] }}%"
                            aria-valuenow="{{ $percentages['not_started'] }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentages['not_started'] }}%</div>
                        <div class="progress-bar fw-medium text-start shadow-none bg-warning px-4" role="progressbar"
                            style="width: {{ $percentages['in_progress'] }}%"
                            aria-valuenow="{{ $percentages['in_progress'] }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentages['in_progress'] }}%</div>
                        <div class="progress-bar fw-medium text-start shadow-none bg-success px-1 px-sm-3 rounded-0 px-lg-4"
                            role="progressbar" style="width: {{ $percentages['completed'] }}%"
                            aria-valuenow="{{ $percentages['completed'] }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentages['completed'] }}%</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-border-top-0">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-error-circle icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Not Started</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $statusCounts['not_started'] }}</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>{{ $percentages['not_started'] }}%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-time icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">In Progress</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $statusCounts['in_progress'] }}</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>{{ $percentages['in_progress'] }}%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class="icon-base bx bx-check-circle icon-lg text-heading"></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Completed</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $statusCounts['completed'] }}</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>{{ $percentages['completed'] }}%</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Vehicles overview -->

        <!-- Pie chart -->
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pie Chart Activity</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="piechart" class="d-flex justify-content-center">

                    </div>
                </div>
            </div>
        </div>
        <!--/ Pie chart -->

        <!-- In Progress activity Table -->
        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">In Progress Activity</h5>
                    </div>
                </div>
                <div class="card-datatable">
                    <table class="table table-sm table-striped table-hover table-responsive" id="in-progress-table">
                        <thead>
                            <tr>
                                <th>Activity Id</th>
                                <th>Activity Name</th>
                                <th>Wo Number</th>
                                <th>Note</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progress as $index => $prgressdata)
                                <tr>
                                    <td>{{ $prgressdata->ActivityId }}</td>
                                    <td>{{ $prgressdata->ActivityName }}</td>
                                    <td>{{ $prgressdata->wo_number }}</td>
                                    <td>{{ $prgressdata->ProgressNote }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100" style="height: 8px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $prgressdata->ProgressPercent }}%"
                                                    aria-valuenow="{{ $prgressdata->ProgressPercent }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="text-body ms-3">{{ $prgressdata->ProgressPercent }}%</div>
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!--/ In Progress activity Table -->
    </div>

@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            piechart();
            setDatatable();
        });

        function setDatatable() {
            var a, e = $("#in-progress-table");
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
                        [0, "asc"],
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

        function piechart() {
            var options = {
                series: [{{ $statusCounts['not_started'] }}, {{ $statusCounts['in_progress'] }},
                    {{ $statusCounts['completed'] }}
                ],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Not Started', 'In Progress', 'Completed'],
                colors: ['#ff3e1d', '#ffab00', '#71dd37'],
                legend: {
                    labels: {
                        useSeriesColors: true
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#piechart"), options);
            chart.render();
        }
    </script>
    {{-- <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-app.js";
        import {
            getAnalytics,
            setUserId,
            logEvent
        } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-analytics.js";

        const firebaseConfig = {
            apiKey: "AIzaSyD66H0kdOAc3pRnWbqhl-yT44VnbYn-xtA",
            authDomain: "reportapp-sis.firebaseapp.com",
            projectId: "reportapp-sis",
            storageBucket: "reportapp-sis.firebasestorage.app",
            messagingSenderId: "303909277727",
            appId: "1:303909277727:web:4a634e43fe8993cab7c52a",
            measurementId: "G-TEZ85KM8CY"
        };

        // Init Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);

        setUserId(analytics, "{{ $user->id }}");

        // Log event login
        logEvent(analytics, 'login', {
            method: 'email'
        });
    </script> --}}
@endpush
