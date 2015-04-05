<?php namespace convercity\Http\Controllers;

use convercity\Broadcast;
use convercity\Helpers\Sender;
use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use convercity\Tag;
use Illuminate\Http\Request;

class SendController extends Controller {

	public function getSend()
	{
		$tags = [];
		foreach(Tag::all() as $tag)
		{
			$tags[] = ['id' => $tag->id, 'text' => $tag->tag];
		}

		$tags = json_encode($tags);

		return view('app.send.send', compact('tags'));
	}

	public function postConfirm(Request $request)
	{
		$tag_id = $request->get('tags');
		$tags = Tag::find($tag_id);
		$citizens =  Sender::tagsToCitizens($tags);
		$message = $request->get('message');
		$broadcast = Broadcast::create([
			'status' => 'Draft',
			'message' => $message,
		]);

		foreach($citizens as $citizen)
		{
			$broadcast->citizens()->save($citizen);
		}

		return view('app.send.confirm', compact('citizens', 'message', 'tags'));

	}
}
