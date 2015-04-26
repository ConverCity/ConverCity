<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Field extends Model {

	protected $fillable = ['name', 'key', 'table_id', 'type'];

    public function table()
    {
        return $this->belongsTo('\convercity\Table');
    }

    public function datamarkers()
    {
    	return $this->hasMany('\convercity\Datamarker');
    }
}
