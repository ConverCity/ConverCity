<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Value extends Model {

	protected $fillable = ['question_id', 'field_id', 'string_value', 'boolean_value', 'integer_value'];

	public function field()
	{
		return $this->belongsTo('\SMAHTCity\Field');
	}

	public function question()
	{
		return $this->belongsTo('\SMAHTCity\Question');
	}

}
