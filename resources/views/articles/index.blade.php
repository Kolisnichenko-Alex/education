@extends('adminlte::page')

@section('content')
    @include('shared.flash')
    @include('shared.alerts')
    <div class="box-body">
        <table class="table table-striped table-hover" id="siswa-table">
            <thead>
            <th>#</th>
            <th>Title</th>
            <th>Text</th>
            <th>
                <div class="text-right">
                    <a class="btn btn-info" href="{{ route('articles.create') }}" role="button">
                        <i class="fas fa-plus"></i>{{ __('Create new Article') }}
                    </a>
                </div>
            </th>
            </thead>
            <tbody>
            <?php $no = 1;?>
            @foreach ($articles as $key => $value)
                @if( Auth::user()->account_type == 'admin'||
                 (Auth::user()->account_type == 'publisher' && ($value->user_id == Auth::id()) ) )
                    <tr @if(($value->published) xor ($value->favorite)) class="alert-default-primary"
                        @elseif($value->favorite && $value->published) class="alert-default-success"@endif>
                        <th>{{ $no++ }}</th>
                        <th>{{ $value->title }}</th>
                        <th> {!! Str::limit($value->text, 30, ' ...') !!} </th>
                        <th class="text-right">
                            <div class="text-right" style="display:inline-block">
                                <a href="{{route('articles.show', $value->id)}}" title="View"
                                   class="btn btn-outline-primary">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{route('articles.edit', $value->id)}}" title="Edit"
                                   class="btn btn-outline-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @if( Auth::user()->account_type == 'admin')
                                    <a href="{{route('articles.publish', $value->id)}}"
                                       title="{{$value->published ? 'Unpablish' : 'Publish'}}"
                                       class="btn btn-outline-info">
                                        <i class="fas {{ $value->published ? 'fa-file-download' : 'fas fa-file-upload'}}"></i>
                                    </a>
                                    <a href="{{route('articles.favorite-admin', $value->id)}}"
                                       title="{{$value->favorite ? 'Unfavorite' : 'Favorite'}}"
                                       class="btn btn-outline-info">
                                        <i class="fas {{ $value->favorite ? 'fas fa-heart-broken' : 'fas fa-heart'}}"></i>
                                    </a>
                                @endif
                                <form action="{{route('articles.destroy', $value->id)}}" method="post"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Are you sure, you want to delete {{$value->title}} ?')">
                                    {!! csrf_field() !!}
                                    {!! method_field('delete') !!}
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
