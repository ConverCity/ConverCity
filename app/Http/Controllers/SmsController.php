<?php namespace SMAHTCity;

use SMAHTCity\Http\Requests;
use SMAHTCity\Http\Controllers\Controller;


use Illuminate\Http\Request;
use vendor\twilio\sdk\Services\Twilio;

class SmsController extends Controller {


	public function getIncomingText()
	{

	//Get all inputs
		$input = $_GET;

	//Is this a fake phone?
		if(isset($input['method']) && $input['method'] == 'fake-phone')
		{
			return view('fake-phone');
		}

    //Is the phone number set?
        if(isset($input['From']))
        {
            $citizen = \SMAHTCity\Citizen::firstOrCreate(array('phone' => $input['From']));
        }

    //Load the interaction instance
        $interaction = \SMAHTCity\Interaction::firstOrCreate(array('citizen_id' => $citizen->id));

    //If not the interaction load the last question
        if($interaction->lastQuestion != null)
        {
            $last_question = $interaction->lastQuestion;
        }

    //Create response instance
        $response = \SMAHTCity\Response::create(array('response' => $input['Body'], 'interaction_id' => $interaction->id));

        if(isset($last_question->question_id))
        {
            $response->reply_question_id = $last_question->last_question_id;
            $response->save();
        }

        // Test the body
        $body = $input['Body'];
        if(isset($body)) {
            if (isset($last_question)) {
                $next_question = Sms311::compareToQuestion($body, $last_question);
            } else {
                $next_question = Sms311::compareToQuestion($body);
            }

            if($next_question == null) {
                $message = 'I\'m sorry, I don\'t think I understand your question';
                $interaction->last_question_id = $interaction->last_question_id;
            }
            else {
                // Extract the question from the next question
                $interaction->last_question_id = $next_question->id;
                $message = $next_question->question;
                $interaction->save();

            }
        }

    //Genderate $to variable
		if(isset($input['From'])) { $to = $input['From']; }

    // Log message
		$log = new \SMAHTCity\Log;
		$log->type = 'incoming-sms';
		$log->number = $to;
		$log->data = json_encode($_GET);
		$log->save();

	// Create the response message

		$account_sid = env('TWI_SID');
		$auth_token = env('TWI_TOKEN');
		$client = new \Services_Twilio($account_sid, $auth_token);
		if(isset($to))
		{
			if($input['fake'])
			{
				return view('fake-phone', compact('message', 'citizen', 'body'));
			}
			elseif( $client->account->messages->create(array(
					'To' => $to,
					'From' => "+16175453311",
					'Body' => $next_question->question,
				)))
				{
					// Log message
					$log = new \SMAHTCity\Log;
					$log->number = $to;
					$log->type = 'outgoing-sms';
					$log->data = json_encode(['question_id' => $next_question->id, 'message' => $next_question->qestion]);
					$log->save();
				}
		}

		return response('success', '200');

	}

		/**
     * @param $body
     * @param $question
     * @return \Illuminate\Support\Collection|null|static
     */

    function compareToQuestion($body, $question = null)
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
