<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $fillable = ['tag'];

	public function citizens()
	{
		return $this->belongsToMany('convercity\Citizen');
	}

}
