<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model {

	protected $fillable = ['phone'];

    public function user()
    {
        return $this->belongsTo('\SMAHT\User');
    }

    public function responses()
    {
        return $this->hasMany('\SMAHT\Response');
    }

}
