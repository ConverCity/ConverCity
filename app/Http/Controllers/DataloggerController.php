<?php namespace convercity\Http\Controllers;

use convercity\Helpers\Datalogger;
use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use convercity\Table;
use convercity\Field;
use Illuminate\Http\Request;

class DataloggerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$tables = Table::orderBy('name')->get();

		return view('app.datalogger.index', compact('tables'));
	}

	public function getTableFields($id)
	{
		$table_id = $id;
		$fields = Table::find($table_id)->fields;

		return view('api.field_menu', compact('fields', 'table_id'));
	}

	public function getSetField($id)
	{
		$field = Field::find($id);
		if($field->type == 'boolean') return view('api.fields.boolean', compact('field'));

		return view('api.fields.string');
	}


}


