<?php namespace convercity\Http\Controllers;

use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AppPagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('app.dashboard');
	}

}
