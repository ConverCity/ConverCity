@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-offset-1 col-lg-10">
            <h2>Questions</h2>
            <a class="btn btn-primary" href="/question/create">Create New Question</a>
            <table class="table">
                <thead>
                <td style="max-width: 25px"></td>
                <td>Question</td>
                <td>Created</td>
                <td>Edited</td>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td><a href="/question/{{$question->id}}/edit/">Edit</a></td>
                            <td>{{$question->question}}</td>
                            <td>{{$question->created_at->diffForHumans()}}</td>
                            <td>{{$question->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

@stop