<?php namespace SMAHTCity\Http\Controllers;

use SMAHTCity\Http\Requests;
use SMAHTCity\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $questions = \SMAHTCity\Question::all();
		return view('question.index', compact('questions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('question.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $q = new \SMAHTCity\Question;
        $q->question = $request->get('question');
        $q->answer = $request->get('answer');
        $q->keywords = $request->get('keywords');
        if($parent_id = $request->get('parent_id'))
        {$q->parent_id = $parent_id;}
    	if($request->get('is_topic'))
        $q->is_topic = true;
        $q->save();

        if(null != $request->get('parent_id'))
        {
            return redirect()->back();
        }
        else
        {
            return redirect('/question-tree/');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$question = \SMAHTCity\Question::find($id);
        $children = \DB::table('questions')->where('parent_id', $id)->get();
        return view('question.edit', compact('question', 'children'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        $q = \SMAHTCity\Question::find($id);
        $q->question = $request->get('question');
        $q->answer = $request->get('answer');
        $q->keywords = $request->get('keywords');
        if($parent_id = $request->get('parent_id'))
        {$q->parent = $parent_id;}
        $q->save();

        \Session::flash('flash_success', 'Question successfully updated');


        return redirect('/question/');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\SMAHTCity\Question::find($id)->delete();
		
        return redirect()->back();
	}

}
