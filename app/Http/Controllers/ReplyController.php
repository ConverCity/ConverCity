<?php namespace convercity\Http\Controllers;

use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use convercity\Reply;
use convercity\Keyword;
use Illuminate\Http\Request;

class ReplyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Reply::with('keywords')->get();
	}

	/**
	 * Store a newly reply and keywords
	 *
	 * @return if Ajax return new reply ID
	 *
	 * @return if browser redirect back
	 *
	 */
	public function store(Request $request)
	{
		$reply = $request->get('reply');
		$keywords = $request->get('keyword') or [];

		$reply = Reply::create($reply);

		if($keywords != null)
		{
			foreach($keywords as $i)
			{
				$keyword = Keyword::firstOrCreate($i);
				$reply->keywords()->save($keyword);
			}
		}

		if($request->ajax())
			{return response($reply->id, 200);}
		else
			{return redirect()->back();}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Request $request)
	{
		$reply = Reply::find($id);
		if($request->ajax())
			{
			return $reply;
			}
		else
		{
			return view('app.replies.show', compact('reply'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id )
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$reply = Reply::find($id)->update($request->get('reply'));
		$keywords = $request->get('keyword') or [];

		if($keywords->count() > 0)
		{
			foreach($keywords as $i)
			{
				$keywords[] = Keyword::firstOrCreate($i);
			}

			$reply->sync($keywords);
		}
		if($request->ajax())
		{return response($reply->id, 200);}
		else
		{return redirect()->back();}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Reply::find($id)->delete();

			return response("Success");

	}

}
