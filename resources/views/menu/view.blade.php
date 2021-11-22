@extends('adminlte::page')

@section('content')
    <div class="box-body">

        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label text-md-center">{{ __('Title') }}</label>
            <div class="col-md-10">
                <h3>{{ $menuItem->title }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="url" class="col-sm-1 col-form-label text-md-center">{{ __('Url') }}</label>
            <div class="col-md-10">
                <h3>{{ $menuItem->url }}</h3>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('menu.index') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ route('menu.edit', $menuItem->id) }}" role="button"><i class="fas fa-pen"></i> {{ __('Edit') }}</a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
