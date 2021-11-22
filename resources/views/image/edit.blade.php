@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        {!! Form::model($image, [
       'method' => 'PUT',
       'route' => ['image.update', $image->id],
       'files' => true
       ])!!}

        <div class="form-group row">
            <label for="url" class="col-sm-1 col-form-label text-md-center">{{ __('Url :') }}</label>
            <div class="col-md-10">
                <h3>{{ $image->url }}</h3>
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

        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-1 col-form-label text-md-center">
                {!! Form::label('Articles :')!!}
            </div>
            <div class="col-md-10">
                <select name="articles[]" class="form-control select-tag" multiple>
                    @foreach($articles as $article)
                            @if  (!$articles_selected->contains('article_id', $article->id))
                                <option value="{{$article->id}}"> {{$article->title}} </option>
                            @endif
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-4">
        @csrf
        <div class="form-group row">
            <div class="col-sm-1 col-form-label text-md-center">
                {!! Form::label('Change Image')!!}
            </div>
            <div class="col-md-10">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image"
                               aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
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
