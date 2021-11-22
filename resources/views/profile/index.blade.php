@extends('adminlte::page')

@section('content')
    <div class="box-body">

        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label text-md-center">{{ __('Your name :') }}</label>
            <div class="col-md-9">
                <h3>{{ Auth::user()->name }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label text-md-center">{{ __('Your email :') }}</label>
            <div class="col-md-9">
                <h3>{{ Auth::user()->email  }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="articles" class="col-sm-3 col-form-label text-md-center">{{ __('Articles written :') }}</label>
            <div class="col-md-9">
                <h3>{{ $articles }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="comments" class="col-sm-3 col-form-label text-md-center">{{ __('Comments posted :') }}</label>
            <div class="col-md-9">
                <h3>{{ $comments }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="account_type" class="col-sm-3 col-form-label text-md-center">{{ __('Your role :') }}</label>
            <div class="col-md-9">
                <h3>{{ Auth::user()->account_type  }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('dashboard') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ ('password/reset') }}" role="button"><i class="fas fa-pen"></i> {{ __('Change Password') }}</a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
