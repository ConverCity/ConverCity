<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Datamarker extends Model {

	protected $fillable = ['reply_id', 'message_id', 'field_id', 'value'];

}
