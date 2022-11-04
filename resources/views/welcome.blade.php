@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row align-self-center">
        <div class="col-md-6">
            <div class="card">
                <a href="{{ route('login') }}" class="btn btn-lg btn-primary">Login</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Register</a>
            </div>
        </div>
    </div>
</div>

@endsection
