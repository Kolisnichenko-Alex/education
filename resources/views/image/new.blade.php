@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        {!! Form::open([
        'method' => 'POST',
        'route' => 'image.store',
        'files' => true
        ]) !!}

        <hr class="my-4">
        @csrf
        <div class="form-group row">
            <div class="col-sm-1 col-form-label text-md-center">
                {!! Form::label('Choose image')!!}
            </div>
            <div class="col-md-10">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-1 col-form-label text-md-center">
                {!! Form::label('Articles')!!}
            </div>
            <div class="col-md-10">
                <select name="articles[]" class="form-control select-tag" multiple>
                    @foreach($articles as $article)
                        <option value="{{$article->id}}" {{in_array($article->id, old("articles") ?: []) ? "selected": ""}}>{{$article->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('image.index') }}" role="button">Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-info', 'title' => 'Save']) !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
