<?php namespace convercity\Http\Controllers;

use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FrontEndController extends Controller {

	/**
	 * Display core app home
	 *
	 * @return Response
	 */
	public function home()
	{
		return view('cover');
	}


}
