<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 3/2/15
 * Time: 12:00 PM
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuestionSeeder extends Seeder
{

    public function run()
    {
        \SMAHTCity\Question::truncate();
        \SMAHTCity\Response::truncate();
        \SMAHTCity\Interaction::truncate();
        \SMAHTCity\Citizen::truncate();

        $question = new \SMAHTCity\Question;
        $question->question = 'This is topic one, now look for "two", "three", or "four"';
        $question->keywords = 'start, beginning, first';
        $question->answer = 'Trying to start';
        $question->is_topic = true;
        $question->save();

        $child = new \SMAHTCity\Question;
        $child->question = 'This is question two, now look for "five" or "six"';
        $child->keywords = 'two';
        $child->answer = 'Two';
        $child->parent_id = $question->id;
        $child->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question five, now look for "start"';
        $grandchild->keywords = 'five';
        $grandchild->answer = 'Five';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question six, now look for "start"';
        $grandchild->keywords = 'six';
        $grandchild->answer = 'Six';
        $grandchild->parent_id = $child->id;
        $grandchild->save();


        $child = new \SMAHTCity\Question;
        $child->question = 'This is question three, now look for "seven" or "eight"';
        $child->keywords = 'three';
        $child->answer = 'Three';
        $child->parent_id = $question->id;
        $child->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question seven, now look for "start"';
        $grandchild->keywords = 'seven';
        $grandchild->answer = 'Seven';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question eight, now look for "start"';
        $grandchild->keywords = 'eight';
        $grandchild->answer = 'Eight';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $child = new \SMAHTCity\Question;
        $child->question = 'This is question four, now look for nine or ten';
        $child->keywords = 'four';
        $child->answer = 'Four';
        $child->parent_id = $question->id;
        $child->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question nine, now look for "start"';
        $grandchild->keywords = 'nine';
        $grandchild->answer = 'Nine';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question ten, now look for "start"';
        $grandchild->keywords = 'ten';
        $grandchild->answer = 'Ten';
        $grandchild->parent_id = $child->id;
        $grandchild->save();
    }
}
