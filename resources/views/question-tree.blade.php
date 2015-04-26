@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-offset-1 col-lg-10">
            <h1>Question Tree</h1>
                </br>
            <a class="btn btn-primary btn-sm" href="/question/create">Add New Topic</a>
            <br>
            <br>
            <ul>

            @foreach($topics as $topic)
                    <li class="" id="topic-{{$topic->id}}"><a href="/question/{{$topic->id}}/edit">{{$topic->answer}}</a>   <button class="btn btn-danger btn-xs" onclick="deleteTopic({{$topic->id}})">Delete</button></li>
                @if($topic->children)
                    <ul >
                        @foreach($topic->children as $c1)
                        <li><a href="/question/{{$c1->id}}/edit">{{$c1->answer}}</a></li>
                            @if($c1->children)
                                <ul>
                                    @foreach($c1->children as $c2)
                                        <li><a href="/question/{{$c2->id}}/edit">{{$c2->answer}}</a></li>
                                        @if($c2->children)
                                            <ul>
                                                @foreach($c2->children as $c3)
                                                    <li><a href="/question/{{$c3->id}}/edit">{{$c3->answer}}</a></li>
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

@section('js-foot')
<script >
    function deleteTopic(id)
    {
        var url = /question/ + id;
        var topicID = '#topic-' + id;
        $( topicID ).addClass('fade');
        $.ajax({
            url: url,
            type: "POST",
            data: {'_method': 'DELETE', '_token': "{{ csrf_token() }}"}
        }).done(function(){
            $( topicID ).addClass('hidden');
        });
    }
</script>

@stop