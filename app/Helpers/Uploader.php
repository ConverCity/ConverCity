<?php


namespace convercity\Helpers;


use convercity\Citizen;
use convercity\Tag;
use convercity\User;
use Maatwebsite\Excel\Facades\Excel;

class Uploader {


    /**
     * @param $file
     * @return count of created citizens
     */
    static function csvToCitizens($file)
    {
        $citizens = Excel::load($file, function($reader){$reader->toArray();});
        $citizens = $citizens->parsed;
        $count = null;
        foreach($citizens as $citizen)
        {
            $new = Citizen::firstOrCreate([
                'phone_number' => Uploader::cleanPhoneNumber($citizen->telephone)
            ]);


                $count++;
                $user = User::firstOrCreate(['email' => $citizen->email]);
                if($citizen->first_name != null) $user->first_name = $citizen->first_name;
                if($citizen->last_name != null) $user->last_name = $citizen->last_name;
                $user->save();

                $new->user_id = $user->id;
                $new->save();

                if($citizen->tag1)
                {
                    $tag = Tag::firstOrCreate(['tag' => $citizen->tag1]);
                    $new->tags()->save($tag);
                }
                if($citizen->tag2)
                {
                    $tag = Tag::firstOrCreate(['tag' => $citizen->tag2]);
                    $new->tags()->save($tag);
                }
                if($citizen->tag3)
                {
                    $tag = Tag::firstOrCreate(['tag' => $citizen->tag3]);
                    $new->tags()->save($tag);
                }
                if($citizen->tag4)
                {
                    $tag = Tag::firstOrCreate(['tag' => $citizen->tag4]);
                    $new->tags()->save($tag);
                }
                if($citizen->tag5)
                {
                    $tag = Tag::firstOrCreate(['tag' => $citizen->tag5]);
                    $new->tags()->save($tag);
                }

        }
        return $count;
    }


    /**
     * @param $number
     * @return int phone number
     */

    static function cleanPhoneNumber($number)
    {
       $num =  preg_replace('[\D]', '', $number);

        if($num[0] != 1)
        { $num = '1' . $num; }

        return $num;
    }

}