<?php namespace SMAHTCity;

use SMAHTCity\Http\Requests;
use SMAHTCity\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SMS311 extends Controller {

	public static function compareToQuestion($body, $question = null)
	{
			$words = strtolower($body);
			$words = explode(' ', $words);
			if($question == null || $question->children()->count() == 0)
			{
					$answers = \SMAHTCity\Question::select('id', 'keywords')->where('is_topic', true)->get();
			}
			else
			{
					$answers = $question->children;
			}

		//Score the answers

					foreach($answers as $answer)
					{

							//set default score
							$scores[$answer->id] = 0;

							//prepare the keyword array
							$keywords = explode(', ', $answer->keywords);

							//test each keyword
							foreach($keywords as $keyword)
							{
									//against each word
									foreach($words as $word)
									{
											//if word matches, give one point
											if($keyword == $word)
											{

													$scores[$answer->id]++;

											}
									}
							}
					}

			//sort scores, highest to lowest and pull id of the higest
			arsort($scores);
			reset($scores);
			$id = key($scores);

			if($scores[$id] == 0)
					{$response = null;}
			else
					//Pull the question based on ID;
					{$response = \SMAHTCity\Question::find($id);}

			return $response;
	}

	public static function questionWords($id)
	{
		$question = \SMAHTCity\Question::find($id);

		// Create words variable
		$words = [];

		if($question->responses == null)
		{
			return false;
		}

		// Add words to array
		foreach($question->responses as $response)
		{
			$newWords = explode(' ', $response->response);
			$words = array_merge($newWords, $words);
		}

		return json_encode($words);

	}

	public static function cleanName($name){
    $name = strtolower($name);
    $name = preg_replace('/[^a-z0-9 -]+/', '', $name);
    $name = str_replace(' ', '-', $name);
    return trim($name, '-');
}
}
