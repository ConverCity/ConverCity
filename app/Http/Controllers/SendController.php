<?php namespace convercity\Http\Controllers;

use convercity\Broadcast;
use convercity\Helpers\Sender;
use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use convercity\Tag;
use convercity\Table;
use convercity\Keyword;
use Illuminate\Http\Request;

class SendController extends Controller {

	public function getSend()
	{
		$tags = [];
		foreach(Tag::all() as $tag)
		{
			$tags[] = ['id' => $tag->id, 'text' => $tag->tag];
		}
		$dataSets = [];
		foreach(Table::all() as $set)
		{
			$dataSets[] = ['id' => $set->id, 'text' => $set->name];
		}
		$keywords = [];
		foreach(Keyword::all() as $set)
		{
			$keywords[] = ['id' => $set->id, 'text' => $set->keyword];
		}

		$tags = json_encode($tags);
		$dataSets = json_encode($dataSets);
		$keywords = json_encode($keywords);


		return view('app.send.send', compact('tags', 'dataSets','keywords'));
	}

	public function postConfirm(Request $request)
	{
		$send = $request->get('send');
		$tag_id = $send['tags'];
		$tags = Tag::find($tag_id);
		$citizens =  Sender::tagsToCitizens($tags);
		$message = $send['message'];
		$broadcast = Broadcast::create([
			'status' => 'Draft',
			'message' => $message,
		]);

		foreach($citizens as $citizen)
		{
			$broadcast->citizens()->save($citizen);
		}

		$send = json_encode($send);

		return view('app.send.confirm', compact('citizens', 'message', 'tags', 'send'));

	}
}
