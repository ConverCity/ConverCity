<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model {

    protected $fillable = ['citizen_id'];

	public function citizen()
	{
		return $this->belongsTo('\SMAHTCity\Citizen');
	}

	public function responses()
	{
		return $this->hasMany('\SMAHTCity\Response');
	}

    public Function lastQuestion()
    {
        return $this->hasOne('\SMAHTCity\Question', 'id', 'last_question_id');

    }

}
