<?php namespace SMAHTCity\Http\Controllers;

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
}
