@extends('layouts.login')

@section('title', 'Login')

@section('content')
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">

        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset('img/illustrations/boy-with-rocket-light.png') }}" class="img-fluid" alt="Login image"
                        width="700" data-app-dark-img="illustrations/boy-with-rocket-dark.png"
                        data-app-light-img="illustrations/boy-with-rocket-light.png" />

                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto">
                    <div class="d-flex justify-content-center mb-10">
                        <img src="{{ asset('img/logo/logo-sis.png') }}" class="img-fluid" alt="logo sis" width="100" />
                    </div>
                    <h4 class="mb-1">Welcome Report Application 👋</h4>
                    <p class="mb-7">Please sign-in to your account</p>

                    <form method="POST" class="mb-6" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-6 form-control-validation">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" autocomplete="email"
                                placeholder="Enter your email" autofocus />
                        </div>
                        <div class="form-password-toggle form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input type="password" id="password" class="form-control" name="password"
                                    autocomplete="password" placeholder="············" aria-describedby="password">
                                <span class="input-group-text cursor-pointer" style="z-index: 99"><i
                                        class="icon-base bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="my-7">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                                    <label class="form-check-label" for="remember-me">Remember Me</label>
                                </div>
                                <a class="d-none" href="auth-forgot-password-cover.html">
                                    <p class="mb-0">Forgot Password?</p>
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger  text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('Login page scripts loaded');
            // Jalankan init di sini
            //Helpers.initPasswordToggle();
            console.log('Login page scripts loaded 2');
        });
    </script>
@endpush
