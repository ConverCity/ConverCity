<?php namespace SMAHTCity\Http\Controllers;

use SMAHTCity\Http\Requests;
use SMAHTCity\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Http\Request;

class VariableController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return view('variable.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore(Request $request)
	{
		$table_name = 'var-' . \SMAHTCity\SMS311::cleanName($request->get('name'));

		if(\SMAHTCity\Variable::where(['table' => $table_name])->exists())
		{
			\Session::flash('flash_warning', 'Variable name already exists, please try again.');
			return redirect()->back();
		}
		
		//create record of variable
			$var = new \SMAHTCity\Variable;
			$var->name = $request->get('name');
			// Sanatize and set table name
			$var->table = $table_name;
			$var->type = $request->get('type');
			// save variable record
			$var->save();

			//create and save the values
			foreach($request->get('variables') as $variable)
			{
				$var->values()->create(['value' => $variable, 'variable_id' => $var->id]);
			}
			
		//create variable table
			\Schema::create($table_name, function(Blueprint $table) use ($var, $request)
			{
				$table->increments('id');
				$table->integer('citizen_id');
				if($var->type == 'boolean')
					foreach ($request->get('variables') as $variable) {
						$table->boolean(\SMAHTCity\SMS311::cleanName($variable));
					}
				elseif($var->type == 'string')
					foreach ($request->get('variables') as $variable) {
						$table->string(\SMAHTCity\SMS311::cleanName($variable));
					}
				elseif($var->type == 'integer')
					foreach ($request->get('variables') as $variable) {
						$table->integer(\SMAHTCity\SMS311::cleanName($variable));
					}
			});

			return redirect()->back();
	}

	public function getAttach($question, $variable)
	{
		$variable = \SMAHTCity\Variable::find($variable);
		$question = \SMAHTCity\Question::find($question);
		$question->variables()->attach($variable);

		return '<li class="list-group-item">' . $variable->name . '</li>';
	}

}
