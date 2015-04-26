@extends('app')

@section('content')



<div class="row">

  <div class="col-md-offset-2">

    <div class="col-md-8">
    @if(isset($citizen))
        <div class='alert alert-info'><strong>Last Response</strong><br> {{$body}} </div>
    @endif
    @if(isset($message))
      <div class='alert alert-info'><strong>Last Question</strong><br> {{ $message }} </div>
    @endif


      <form action="/sms-interface/" method="get">

      <input name="From" class="form-control" value="test" placeholder="Your Phone Number">
      <br>
      <textarea name="Body" class="form-control"></textarea>
      <input type="hidden" name="method" value="test">
      <br>
      <label>Return message to browser
          <input type="checkbox" name="fake" checked>
      </label>
      <br>
          <br>

      <input type="submit" class='btn btn-primary' value="Send Message">

      </form>

    </div>

  </div>

</div>

@stop
