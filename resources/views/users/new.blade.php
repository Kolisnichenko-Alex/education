@extends('adminlte::page')

@section('content')
    <div class="box-body">
        {!! Form::open([
        'method' => 'POST',
        'route' => 'users.store',
        'files' => false
        ]) !!}
        @include('shared.flash')
        @include('shared.alerts')
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-8">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Email') }}</label>
            <div class="col-md-8">
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="col-md-8">
                {!! Form::text('password', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="account_type" class="col-sm-4 col-form-label text-md-right">{{ __('Account Type') }}</label>
            <div class="col-md-8 align-content-center">
                {!! Form::select('account_type', Config::get('values.enums')) !!}
            </div>
        </div>

        <div class="box-footer">
            <div class="text-right">
                <a class="btn btn-info" href="{{ route('users.index') }}" role="button">Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'title' => 'Save']) !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
