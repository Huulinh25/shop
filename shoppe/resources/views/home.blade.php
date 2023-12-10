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

                    {{ __('Welcome!') }}
                    <a href="admin/dashboard">Click here to Homepage</a>
                    <br/>
                </div>
            </div>
            <a href="{{ route('getLogin') }}">You are not an admin? Please click here to login member</a>
        </div>
    </div>
</div>
@endsection
