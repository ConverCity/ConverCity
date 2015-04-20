@extends('layouts.app')

<?php
    
    $page = [
        'id'    => 'replie_detail',
        'name' => 'Reply Detail: ' . $reply->reply,
        ]

?>

@section('main')

    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    Reply: {{$reply->reply}}
                </h4>
            </div>
            <div class="panel-body">
                <p><strong>
                        Keywords
                    </strong>
                </p>
                <p>
                    @foreach($reply->keywords as $word)
                        <span class="label label-default">
                            {{$word->keyword}}
                        </span>
                        @endforeach
                </p>


            </div>
        </div>
    </div>

    @stop