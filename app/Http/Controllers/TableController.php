<?php namespace convercity\Http\Controllers;

use convercity\Helpers\Datalogger;
use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use convercity\Table;
use Illuminate\Http\Request;

class TableController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Table::with('fields')->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('angular.table.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if($request->ajax())
		{
			$table = Datalogger::createDataTable($request->get('name'));
			return view('api.data_set_panel', compact('table'));
		}

		return false;

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Table::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('angular.table.edit')->with('table', Table::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		return Table::find($id)->update($request->get('table'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Table::find($id)->delete();
	}

}
