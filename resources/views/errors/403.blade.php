@extends('layouts.dashboard')

@section('title', 'Error 403')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container-xxl">
                <div class="misc-wrapper my-5">
                    <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">403</h1>
                    <h4 class="mb-2 mx-2">Access Denied! 🔐</h4>
                    <p class="mb-6 mx-2">You don’t have permission to access this page!</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">Back to Dashboard</a>
                    {{-- <div class="mt-6">
                        <img src="{{ asset('img/illustrations/page-misc-error-light.png') }}" class="img-fluid"
                            alt="Login image" width="100" data-app-dark-img="illustrations/page-misc-error-light.png"
                            data-app-light-img="illustrations/page-misc-error-light.png" />
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script></script>
@endpush
