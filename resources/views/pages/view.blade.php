@extends('adminlte::page')

@section('content')
    <div class="box-body">

        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label text-md-center">{{ __('Title') }}</label>
            <div class="col-md-10">
                <h3>{{ $page->title }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="html" class="col-sm-1 col-form-label text-md-center">{{ __('HTML') }}</label>
            <div class="col-md-10">
                <h3>{{ $page->html }}</h3>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('pages.index') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ route('pages.edit', $page->id) }}" role="button"><i class="fas fa-pen"></i> {{ __('Edit') }}</a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
