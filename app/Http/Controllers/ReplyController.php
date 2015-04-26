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
	 * Store a new reply and keywords
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

		// Store reply
		$reply = Reply::create($reply);


		// Attach keywords to reply
		if($keywords != null)
		{
			foreach($keywords as $i)
			{
				$keyword = Keyword::firstOrCreate($i);
				$reply->keywords()->save($keyword);
			}
		}

		// Ajax return test
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
		// Retreve reply
		$reply = Reply::find($id);

		// Return reply
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
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		// Load reply object
		$reply = Reply::find($id)->update($request->get('reply'));

		// Retreive keywords
		$keywords = $request->get('keyword') or [];

		// Find or create keyword objects
		if($keywords->count() != 0)
		{
			foreach($keywords as $i)
			{
				$keywords[] = Keyword::firstOrCreate($i);
			}

			// Attach Keywords to Reply
			$reply->sync($keywords);
		}

		// Ajax return test
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

		// Ajax return test
		if($request->ajax())
			{return response("Success");}
		else
			{return redirect('/app/message-builder');}
			

	}

}
