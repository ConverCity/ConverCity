<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model {

	protected $fillable = ['phone_number', 'user_id'];

	/**
	 *
	 * Related User Model
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function user()
	{
		return $this->belongsTo('\convercity\User');
	}

	/**
	 *
	 * Object of incoming messages
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function incomings()
	{
		return $this->hasMany('\convercity\Incoming');
	}

	/**
	 *
	 * Object of related Tags
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function tags()
	{
		return $this->belongsToMany('\convercity\Tag');
	}


}
