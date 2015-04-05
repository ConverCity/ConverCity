@extends('layouts.app')

@section('main')

    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default">
            <form method="post" action="{{action('SendController@postConfirm')}}">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="panel-heading">
                    <h4>
                        Send a Message
                    </h4>
                </div>

                <div class="panel-body" >
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" id="message" name="message" class="form-control">
                        <span id="count"></span>
                    </div>

                    <div class="form-group">
                        <label>Send Tags</label>
                        <select id="tags" class="tags form-control" name="tags[]" multiple="multiple">
                        </select>
                    </div>

                </div>
                <div class="panel-footer">
                    <input type="submit" value="Preview Message" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    @stop

@section('style')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
@stop

@section('js-foot')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.tags').select2({
                tags: true,
                data: {!! $tags !!},
            });
        });

        $('#message').change(function() {

            var message = document.getElementById("message").value;

            document.getElementById("count").innerHTML = message.length;
        });

        var $eventSelect = $('#tags');
        $eventSelect.on("change", function (e) { console.log(e); });
    </script>
    @stop