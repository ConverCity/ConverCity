<?php
    
    $page = [
        'id'    => 'message_builder',
        'name' => 'Message Builder',
        ]

?>

@extends("layouts.app")

@section('main')


    <div id="messages" >

        <div class="col-sm-4">
            <div class="well">
                <form action="{{action('ReplyController@store')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="reply[open]" value="true">
                    <div class="form-group">
                        <label>Reply</label>
                        <input name="reply[reply]" class="form-control">

                    </div>
                    <div class="form-group">
                        <label>Keywords</label>
                        <select id="keyword" name="keyword[][keyword]" class="tags form-control" multiple>
                            </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add Reply</button>
                    </div>
                </form>
            </div>
        </div>
        @forelse($replies as $i)
            <div class="col-sm-4" id="reply-{{$i->id}}">
                <div class="panel panel-default">

                    <div class="panel-heading">{{ $i->reply }} <br/></div>
                    <div class="panel-body">
                        <b> Keywords: </b>
                        @foreach($i->keywords as $w)
                            <div class="label label-default">
                                {{ $w->keyword  }}
                            </div>
                        @endforeach

                    </div>
                        <div class="panel-footer">
                        <button onClick="viewReply({{$i->id}})" class="btn btn-primary"> Details </button>
                        <button onClick="deleteReply({{$i->id}})" class="btn btn-danger"> Delete </button>
                    </div>
                    <div class="panel-body" id="footer-{{$i->id}}">
                        <form class="form-inline">
                            <select id="message-{{$i->id}}" name="message-{{$i->id}}" class="messages form-control">
                            </select>
                            <button class="btn btn-primary" onClick="addMessage({{$i->id}}); return false;">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-4">
                <div class="well">

                    No replies currently exist

                </div>
            </div>

        @endforelse
    </div>

@stop

@section('style')
    <!-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" /> -->
    <link href="/css/select2.css" rel="stylesheet" />

@stop

@section('js-head')
@stop

@section('js-foot')

    <script src="/js/select2.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('.tags').select2({

                tags: true
            });

            $('.messages').select2({
                data: {!! $messages !!}
            });
        });

        function deleteReply(id)
        {

            var url = "/app/reply/" + id;
            var reply = '#reply-' + id;
            $(reply).addClass('fade');
            $.ajax(
                    {url:  url,
                    type: "DELETE",
                    data: {_token: "{{csrf_token()}}" }
                    }
            ).success(function(){ $(reply).addClass('hidden') });
        }

        function viewReply(id)
        {
            var url = "/app/reply/" + id;
            window.location = url;
        }

        function addMessage(reply_id)
        {
            var url = "/app/message/";
            var message_id = $('#message-' + reply_id).val();

            $.ajax({
                url: url,
                type: "POST",
                data: {_token: "{{csrf_token()}}", reply_id: reply_id, message_id: message_id}
            }).success(function(data){
                $('#footer-' + reply_id).innerHTML = data;
            });


        }

    </script>
@stop