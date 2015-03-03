<?php namespace SMAHTCity\Http\Controllers;

use SMAHTCity\Http\Requests;
use SMAHTCity\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StaticPages extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function questionTree()
	{
		$topics = \SMAHTCity\Question::where('is_topic', true)->get();
		return view('question-tree', compact('topics'));
	}

}
