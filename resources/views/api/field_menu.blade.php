 <div class="form-group">
	<label>Data Field</label>
	<select name="send[fields][{{$table_id}}]" id="fields" class="form-control" required>
	<option value="">Select a field</option>
	@foreach($fields as $field)
	<option value="{{$field->id}}">{{$field->name}}</option>
	@endforeach
	</select>
</div>

<div id="field-wait" class="hidden">
    <div class="alert alert-info">
        <span class="glyphicon glyphicon-hourglass"></span>  Please wait...
    </div>
</div>
<div id="field-responses"></div>
