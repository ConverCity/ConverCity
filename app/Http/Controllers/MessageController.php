<?php namespace convercity\Http\Controllers;

use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use convercity\Keyword;
use convercity\Message;
use convercity\Tag;
use Illuminate\Http\Request;

class MessageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Message::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if($message = Message::create($request->get('message')))
		{
			if($request->ajax())
			{
				return response($message->id, 200);
			}
			else
			{
				return redirect()->back();
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		Message::find($id)->update($request->get('message'));
		return response('Success');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Message::find($id)->destroy();
		return response("Success");
	}

}
