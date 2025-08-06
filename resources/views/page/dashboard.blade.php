@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Dashboard Page</h4>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            $('#testButton').on('click', function() {
                alert('Hello from jQuery!');
            });
        });
    </script>
@endpush
