<?php
    
    $page = [
        'id'    => 'send_message',
        'name' => 'Send Message',
        ]

?>

@extends('layouts.app')

@section('main')

    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default">
            <form method="post" action="{{action('SendController@postConfirm')}}">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="panel-heading">
                    <h4>Send a Message</h4>
                </div>

                <div class="panel-body" >
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" id="message" name="send[message]" class="form-control">
                        <span id="count"></span>
                    </div>

                    <div class="form-group">
                        <label>Choose Recipient Groups</label>
                        <select id="tags" class="tag form-control" name="send[tags][]" multiple="multiple">
                        </select>
                    </div>

                </div>
                <div class="panel-body" id="datalogger">
                    <h4>Logging Responses</h4>
                    <div class="form-group">
                        <label>Data Set</label>
                        <select id="data-sets" name='send[data-set]' class="sets form-control">
                        </select>
                    </div>
                    <div id="inputs-wait" class="hidden">
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-hourglass"></span>  Please wait...
                        </div>
                    </div>
                    <div id="inputs">
                    
                    </div>

                </div>
                <div class="panel-footer">
                    <input type="submit" value="Preview Message" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    @stop

@section('style')
    <link href="/css/select2.css" rel="stylesheet" />
    <!-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" /> -->
@stop

@section('js-foot')
<script src="/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tags').select2({
                placeholder: 'Begin typing...',
                data: {!! $tags !!},
            });
            $('#data-sets').select2({
                placeholder: "Begin typing...",
                data: {!! $dataSets !!}
            });
        });

        $('#message').change(function() {

            var message = document.getElementById("message").value;

            document.getElementById("count").innerHTML = 'Message length: ' + message.length;
        });

        $('#data-sets').change(function(){
            var set = $('#data-sets').val();
           
            $('#inputs').addClass('hidden');
            $('#inputs-wait').removeClass('hidden');

            $.ajax({
                url: '/app/datalogger/table-fields/' + set,
                type: 'GET'
            }).success(function(data){
                $('#inputs-wait').addClass('hidden');
                $('#inputs').removeClass('hidden');
               document.getElementById("inputs").innerHTML = data;
               $('#fields').change(function(){
                    var field = $('#fields').val();
                    $('#field-responses').addClass('hidden');
                    $('#field-wait').removeClass('hidden');
                    $.ajax({
                        url: '/app/datalogger/set-field/' + field,
                        type: 'GET'
                    }).success(function(data){
                        document.getElementById("field-responses").innerHTML = data;
                        $('#field-wait').addClass('hidden');
                        $('#field-responses').removeClass('hidden');
                        $('.keywords').select2({
                            placeholder: 'Add keywords...',
                            tags: true,
                            data: {!! $keywords !!},
                        });
                    });
                }) 
            });
        })          
</script>
    @stop