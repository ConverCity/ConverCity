<?php namespace convercity;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

	protected $fillable = ['name', 'db_name'];

    public function fields()
    {
        return $this->hasMany('\convercity\Field');
    }

}
