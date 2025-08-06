@extends('layouts.login')

@section('title', 'Error 404')

@section('content')
    <div class="container-xxl">
                <div class="misc-wrapper my-5">
                    <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">404</h1>
                    <h4 class="mb-2 mx-2">Page not found! ⚠️</h4>
                    <p class="mb-6 mx-2">The page you are looking for does not exist.</p>
                    <div class="my-6">
                        <img src="{{ asset('img/illustrations/page-misc-404-light.png') }}" class="img-fluid"
                            alt="Login image" width="300" data-app-dark-img="illustrations/page-misc-404-light.png"
                            data-app-light-img="illustrations/page-misc-404-light.png" />
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
@endsection

@push('scripts')
    <script></script>
@endpush
