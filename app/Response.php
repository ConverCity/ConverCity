<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Response extends Model {

    protected $fillable = ['response', 'interaction_id'];

	public function interaction()
	{
		return $this->belongTo('\SMAHTCity\Interaction');
	}

	public function question()
	{
		return $this->belongsTo('\SMAHTCity\Question');
	}

	public function test()
	{
		return 'you win';
	}

    public function citizen()
    {
        return $this->belongsTo('\SMAHTCity\Citien');
    }


}
