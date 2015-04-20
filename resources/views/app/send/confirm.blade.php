<?php
    
    $page = [
        'id'    => 'send_message',
        'name' => 'Confirm Message',
        ]

?>

@extends('layouts.app')

@section('main')

    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default">
            <form method="post" action="{{action('SendController@postConfirm')}}">
                <div class="panel-heading">
                    <h4>
                        Send a Message
                    </h4>
                </div>

                <div class="panel-body" >
                    <div class="form-group">
                        <label>Message</label>
                        <p>{{$message}}</p>
                    </div>

                    <div class="form-group">
                        <label>Selected Tags</label>
                        @foreach($tags as $tag)
                            <div class="label label-default"> {{$tag->tag}} </div>
                        @endforeach
                        <div>
                            Recipients: {{count($citizens)}}
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <form>
                    <input type="hidden" name="send" value="{!! $send !!}">
                    <input type="submit" value="Confirm Send" class="btn btn-primary">
                    </form>
                </div>
            </form>
        </div>
    </div>

    @stop

@section('style')
@stop

@section('js-foot')


@stop