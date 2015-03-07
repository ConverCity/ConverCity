<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model {

	protected $fillable = ['name', 'table', 'fields'];

}
