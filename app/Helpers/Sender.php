<?php

namespace convercity\Helpers;


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

}