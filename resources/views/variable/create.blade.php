@extends('app')

@section('content')
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <form method="POST" class="form-horizontal" action="{{action('VariableController@store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <h2>Create New Variable</h2>
                <div class="form-group">
                        <label class="control-label col-sm-3">Variable Value</label>
                        <div class="col-sm-9">
                        <input class="form-control" name="variable_name">
                        </div>
                    </div> 

                <div class="form-group">
                        <label class="control-label col-sm-3">Variable Type</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="type[]">
                            <option value=''> Select One </option>
                            <option value='boolean'> True or False </option>
                            <option value='string'> String </option>
                            <option value='integer'> Integer </option>
                        </select>
                        </div>
                    </div>
                <div id="values">    
                    <div class="well">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Variable Value</label>
                            <div class="col-sm-9">
                            <input class="form-control" name="variables[]">
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-sm-offset-10">
                    <button class='btn btn-group' onclick="addValue(); return false;"><i class="fa fa-plus"></i> Add Value</button>
                </div>
                <div class="form-group">
                    <input type="submit" class='btn btn-primary' value="Create Variable">
                </div>
            </form>
        </div>
    </div>
@stop

@section('js-foot')

    <script>

        function addValue()
        {
            var newValue = '<div class="well"> <div class="form-group"><label class="control-label col-sm-3">Variable Value</label><div class="col-sm-9"><input class="form-control" name="variables[]"></div></div> </div>';
            $(newValue).appendTo("#values");
        }
    </script>
@stop
