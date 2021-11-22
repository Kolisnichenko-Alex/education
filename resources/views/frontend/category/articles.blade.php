@include ('frontend.header')
<div>
    <div class="container" style="padding: 10px">
        <div class="card" style="margin: 30px">
            <div class="card-header">
                <h4> Choose an article</h4>
            </div>
            <div class="card-body" style="font-size: larger; font-style: italic">
                @foreach($articles as $key => $item)
                        <a href="{{route('home.article', $item->id)}}" class="card-title"> - "{{$item->title}}" by {{$item->user->name}}</a></br>
                @endforeach
            </div>
        </div>
    </div>
</div>
