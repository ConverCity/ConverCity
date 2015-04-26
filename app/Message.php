<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $fillable = ['message', 'recipients'];


    /**
     * Expected replies to the message
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('convercity\Reply');
    }

    public function citizens()
    {
        return $this->hasMany('convercity\Citizen');
    }
}
