<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

	protected $fillable = ['name', 'db_name'];

    public function field()
    {
        return $this->hasMany('\convercity\Field');
    }

}
