@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <form method="POST" action="{{action('QuestionController@store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" class="form-control" name="question" placeholder="Ask your question...">
                </div>
                <div class="form-group">
                    <label class="form-label">Keywords</label>
                    <textarea class="form-control" name="keywords"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class='btn btn-primary'>
                </div>
            </form>
        </div>
    </div>
@stop
