<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	public function question()
	{
		return $this->belongsTo('\SMAHTCity\Question');
	}
    public function citizen()
    {
        return $this->belongsTo('\SMAHTCity\User');
    }


}
