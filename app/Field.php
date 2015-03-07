<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Field extends Model {

	protected $fillable = ['variable_id', 'name', 'type'];

	public function variable()
	{
		return $this->belongsTo('\SMAHTCity\Variable');
	}

	public function values()
	{
		return $this->hasMany('\SMAHTCity\Field');
	}

}
