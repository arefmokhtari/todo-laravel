

<h1>
    @foreach($names as $name)
        <p>{{$name['name']}} {{$name['family']}}</p>
    @endforeach
</h1>
