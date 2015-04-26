<?php

namespace convercity\Helpers;

use convercity\Field;
use convercity\Keyword;
use convercity\Message;
use convercity\Reply;

class Sender {


    /**
     * @param $tags
     * @return object of citizens
     */
    static function tagsToCitizens($tags)
    {
        $results = [];
        foreach($tags as $tag)
        {
            foreach($tag->citizens as $citizen)
            {
                $results[] = $citizen;
            }
        }

        return array_unique($results);
    }

    static function processBoolean($request)
    {
        $true = Sender::createReply($request->get('true'));
        $false = Sender::createReply($request->get('false'));

        $return = array('true' => $true, 'false' => $false);

        return $return;
    }

    /**
     *
     * Generate a message and attach keywords and return the final object
     *
     * @param array(string, array(string)) $reply
     * @return \convercity\Reply
     */
    static function createReply($reply)
    {

        $newReply = Reply::create(['reply' => $reply['message']]);

        $keywords = null;
        foreach($reply['keywords'] as $word)
        {
            $keywords[] = Keyword::firstOrCreate(['keyword' => $word])->id;
        }

        $newReply->keywords()->attach($keywords);

        return $newReply;
    }

    /**
     *
     * Attached data fields to messages
     *
     * Needs to be build for string, integer
     * and other methods
     *
     * @param object $request
     * @param object $message
     * @return bool
     */

    static function attachFields($request, $message)
    {
        $field = Field::find($request->get('field_id'));
        if($field->type == "boolean")
        { $reply = Sender::processBoolean($request); }
        $message->replies()->saveMany($reply);

        return $reply;
    }

}