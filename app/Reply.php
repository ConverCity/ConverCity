<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $fillable = ['open', 'reply'];


	public function keywords()
	{
		return $this->belongsToMany('\convercity\Keyword');
	}

}
