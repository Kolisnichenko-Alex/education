@include ('frontend.header')
<div>
    <div class="container" style="padding: 10px">
        @foreach($favorite as $key => $item)
            <div class="card" style="margin: 30px">
                <div class="card-header" style="background-color: #7abaff; font-size: larger; font-style: italic; font-weight: bolder">
                    {{$item->title}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Author : {{$item->user->name}}</h5>
                    <blockquote class="blockquote">
                        <p class="card-text mb-0">{!! Str::limit(nl2br(e($item->text)), 300, '...') !!}</p>
                    </blockquote>
                    <a href="{{route('home.article', $item->id)}}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
