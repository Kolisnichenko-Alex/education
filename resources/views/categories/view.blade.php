@extends('adminlte::page')

@section('content')
    <div class="box-body">

        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label text-md-center">{{ __('Title') }}</label>
            <div class="col-md-10">
                <h3>{{ $category->title }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="parent_category_id" class="col-sm-1 col-form-label text-md-center">{{ __('Parent Category ID') }}</label>
            <div class="col-md-10">
                <h3>{{ $category->parent_category_id }}</h3>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ route('categories.edit', $category->id) }}" role="button"><i class="fas fa-pen"></i> {{ __('Edit') }}</a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
