@extends('layouts.login')

@section('main')
	@if (count($errors) > 0)
		<div class="alert">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form role="form" method="POST" action="{{ url('/auth/login') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="text" placeholder="username@example.com" name="email" value="{{ old('email') }}"><br>
	<input type="password" placeholder="password" name="password"><br>
	<label>
		<input type="checkbox" name="remember"> Remember Me
	</label>

	<input type="submit" class="btn" value="Login"><br><br>
	<a href="{{ url('/password/email') }}">Forgot Your Password?</a>
	</form>
@stop