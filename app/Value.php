<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Value extends Model {

	protected $fillable = ['variable_id', 'value'];

	public function variable()
	{
		return $this->belongsTo('\SMARTCity\Variable');
	}

	public function questions()
	{
		return $this->belongsToMany('\SMARTCity\Question');
	}

}
