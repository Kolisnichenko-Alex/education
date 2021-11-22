@extends('adminlte::page')

@section('content')
    @include('shared.flash')
    @include('shared.alerts')
    <div class="box-body">
        <table class="table table-striped table-hover" id="siswa-table">
            <thead>
            <th>#</th>
            <th>Title</th>
            <th>
                <div class="text-right">
                    <a class="btn btn-info" href="{{ route('pages.create') }}" role="button">
                        <i class="fas fa-plus"></i>{{ __('Create new Page') }}
                    </a>
                </div>
            </th>
            </thead>
            <tbody>
            <?php $no =1;?>
            @foreach ($pages as $key => $value)
                <tr>
                    <th>{{ $no++ }}</th>
                    <th>{{ $value->title }}</th>
                    <th class="text-right">
                        <div class="text-right" style="display:inline-block">
                            <a href="{{route('pages.show', $value->id)}}" title="View"
                               class="btn btn-outline-primary">
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{route('pages.edit', $value->id)}}" title="Edit"
                               class="btn btn-outline-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{route('pages.destroy', $value->id)}}" method="post"
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
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
