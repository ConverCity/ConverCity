@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-offset-1 col-lg-10">
            <ul>
                <h1>Question Tree</h1>
            @foreach($topics as $topic)
                    <li><a href="/question/{{$topic->id}}/edit">Edit</a> - {{$topic->question}}</li>
                @if($topic->children)
                    <ul>
                        @foreach($topic->children as $c1)
                        <li><a href="/question/{{$c1->id}}/edit">Edit</a> - {{$c1->question}}</li>
                            @if($c1->children)
                                <ul>
                                    @foreach($c1->children as $c2)
                                        <li><a href="/question/{{$c2->id}}/edit">Edit</a> - {{$c2->question}}</li>
                                        @if($c2->children)
                                            <ul>
                                                @foreach($c2->children as $c3)
                                                    <li><a href="/question/{{$c3->id}}/edit">Edit</a> - {{$c3->question}}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endforeach
            </ul>
        </div>
    </div>

@stop