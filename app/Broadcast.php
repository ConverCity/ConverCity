<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model {

	protected $fillable = ['message', 'status'];

	public function citizens()
	{
		return $this->belongsToMany('convercity\Citizen');
	}

}
