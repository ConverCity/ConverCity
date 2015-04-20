@extends('layouts.app')

<?php
    
    $page = [
        'id'    => 'dataset_manager',
        'name' => 'Data Set Manager',
        ]

?>

@section('main')

    <div id="content">

        <div class="col-sm-6" id="new-set">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>
                        Add New Data Set
                    </strong>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Data Set Name
                            </label>
                            <div class="col-sm-8">
                            <input type="text" id="table-name" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <button onClick="createTable()" class="btn btn-primary btn-sm">Create Data Set</button>
                </div>
            </div>
        </div>
            @forelse($tables as $table)

                @include('api.data_set_panel')

            @empty
                <div class="col-sm-6" id="no-data">
                    <div class="alert alert-info">
                        <p>No data sets currently exist.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>

@stop

@section('model')

    @include('models.create_field')

@stop

@section('js-foot')

    <script>
        function createTable()
        {
            var name = $('#table-name').val();
            $.ajax({
                url: '/app/datalogger/table',
                type: 'POST',
                data: {_token: "{{csrf_token()}}", name: name}
            }).success(function(data){
                $( data ).insertAfter( "#new-set" );
                $("#no-data").addClass('hidden');
            });

        }

        function createField()
        {
            var name = $('#field-name').val();
            var type = $('#field-type').val();
            var id = $("#table-id").val();

            $.ajax({
               url: '/app/datalogger/field',
                type: 'POST',
                data: {_token: "{{csrf_token()}}", field: id + ',' + name + ',' + type }
            }).success(function( data ){
                $( data ).appendTo( '#fields-' + id );
                $( '#empty-' + id ).addClass( 'hidden' );
            });
        }


        $('#addField').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var table = button.data('table') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Add Field to ' + table)
            modal.find('#table-id').val(id)
        });

    </script>

@stop