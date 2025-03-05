@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @auth
                        @if(auth()->user()->role === 'Admin')
                           
                                <a class="dropdown-item" href="{{ route('admin') }}">
                                    <i class="bx bx-cog me-2"></i>
                                    <span class="btn btn-success btn-lg ">Admin Dashboard</span>
                                </a>
                           
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
