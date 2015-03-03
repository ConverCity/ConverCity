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
        $question->is_topic = true;
        $question->save();

        $child = new \SMAHTCity\Question;
        $child->question = 'This is question two, now look for "five" or "six"';
        $child->keywords = 'two';
        $child->parent_id = $question->id;
        $child->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question five, now look for "start"';
        $grandchild->keywords = 'five';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question six, now look for "start"';
        $grandchild->keywords = 'six';
        $grandchild->parent_id = $child->id;
        $grandchild->save();


        $child = new \SMAHTCity\Question;
        $child->question = 'This is question three, now look for "seven" or "eight"';
        $child->keywords = 'three';
        $child->parent_id = $question->id;
        $child->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question five, now look for "start"';
        $grandchild->keywords = 'seven';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question six, now look for "start"';
        $grandchild->keywords = 'six';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $child = new \SMAHTCity\Question;
        $child->question = 'This is question four, now look for nine or ten';
        $child->keywords = 'four';
        $child->parent_id = $question->id;
        $child->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question nine, now look for "start"';
        $grandchild->keywords = 'nine';
        $grandchild->parent_id = $child->id;
        $grandchild->save();

        $grandchild = new \SMAHTCity\Question;
        $grandchild->question = 'This is question ten, now look for "start"';
        $grandchild->keywords = 'ten';
        $grandchild->parent_id = $child->id;
        $grandchild->save();
    }
}
