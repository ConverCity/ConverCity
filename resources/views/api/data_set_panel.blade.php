<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading" type="button"
             data-toggle="collapse" data-target="#collapse-{{$table->id}}"
             aria-expanded="false" aria-controls="collapse-{{$table->id}}">
            <b>{{$table->name}}</b> <small>[ {{$table->db_name}} ]</small>
            <span class="pull-right glyphicon glyphicon-minus">
            </span>
        </div>
        <div class="collapse" id="collapse-{{$table->id}}">
            <div class="panel-body">
                <ul class="list-group" id="fields-{{$table->id}}">
                @forelse($table->fields as $field)

                    @include('api.data_field')

                @empty

                    <li class="list-group-item" id="empty-{{$table->id}}"><i>Data set is empty</i></li>

                @endforelse
                </ul>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#addField" data-id="{{$table->id}}"
                        data-table="{{$table->name}}">Add Field</button>
            </div>
        </div>
    </div>
</div>