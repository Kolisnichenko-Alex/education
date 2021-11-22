@extends('adminlte::page')

@section('content')
    <div class="box-body">

        <div class="form-group row">
            <label for="url" class="col-sm-1 col-form-label text-md-center">{{ __('Id :') }}</label>
            <div class="col-md-10">
                <h3>{{ $image->id }}</h3>
            </div>
        </div>

        <div class="form-group row">
            <label for="url" class="col-sm-1 col-form-label text-md-center">{{ __('Attached Articles :') }}</label>
            <div class="col-md-10">
                <h3>{{ $image->articles->count() }}</h3>
            </div>
        </div>

        <hr class="my-4">
        <label for="image" class="col-sm-1 col-form-label text-md-center">{{ __('Image : ') }}</label>
        <div class="form-group row">
            <label for="image" class="col-sm-1 col-form-label text-md-center">{{ __(' ') }}</label>
            <div class="col-md-10">
                <img src="{{url($image->url)}}" alt="Image" style="max-height: 500px; max-width: 700px"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="url" class="col-sm-1 col-form-label text-md-center">{{ __('Url :') }}</label>
            <div class="col-md-10">
                <h3>{{ $image->url }}</h3>
            </div>
        </div>

        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('image.index') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ route('image.edit', $image->id) }}" role="button"><i class="fas fa-pen"></i> {{ __('Edit') }}</a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
