@extends('app')

@section('content')
    <div class="row">
        @if($question->responses()->count() > 0)
        <div class="col-md-offset-1 col-md-5">
        @else
        <div class="col-md-offset-1 col-md-10">
        @endif
            <div class="well">
                @if($question->parent_id != null)
                    <a class="btn btn-primary pull-right" href="/question/{{$question->parent_id}}">Edit Parent Question</a>
                @endif
                <h3>Edit Question</h3>
                <form method="POST" action="/question/{{$question->id}}">
                    <input type="hidden" name="_method" value ="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="question">Answer</label>
                        <input type="text" value="{{$question->answer}}" class="form-control" name="answer" placeholder="Expected anwser...">
                    </div>
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" value="{{$question->question}}" class="form-control" name="question" placeholder="Ask your question...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keywords</label>
                        <textarea class="form-control" name="keywords">{{$question->keywords}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class='btn btn-primary' value="Update">
                    </div>
                </form>

                <h4>Attach to Variable</h4>
                <form>
                <div class="form-inline">
                    <select class="form-control col-sm-6"id='variable_id' name="variable">
                        <option  value="">Select One</option>
                        @foreach(\SMAHTCity\Variable::all() as $var)
                            <option value="{{$var->id}}">{{$var->name}}</option>
                        @endforeach
                        </select>
                    <button class="btn btn-primary btn-sm" onClick="attachVariable(); return false;">Attach</button>
                </div>
                </form>
                <div id="variable-list" @if($question->variables()->count() == 0) class='hidden' @endif>
                <h4>Related Variables</h4>
                    <ul class="list-group">
                        <span id="variables">
                        @if($question->variables()->count() > 0)
                        @foreach($question->variables as $variable)
                            <li class="list-group-item">{{$variable->name}}</li>
                        @endforeach
                        @endif
                        </span>
                    </ul>
                </div>
                
            </div>
        </div> <!-- / Question Form -->
        @if($question->responses()->count() > 0)
        <div class="col-md-6"> <!-- Word Cloud -->
            <h4>Word cloud from {{$question->responses()->count()}} responses</h4>
            <div id="word-cloud"></div>
        </div> <!-- / Word Cloud -->
        @endif
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-lg-10">
        <h3>Possible Answers</h3>
            <div class="row">
                @foreach($children as $quest)
                    <div class="col-sm-5">
                        <div class="well">
                        <p><strong>Answer: </strong>{{$quest->answer}}</p>
                        <p><strong>Question:</strong> {{$quest->question}}</p>
                        <p><strong>Keywords:</strong>
                        {{$quest->keywords}}</p>
                            @if($question->variables()->count() > 0)
                            <strong>Associated Values</strong><br>
                            @forelse(\SMAHTCity\Value::where('question_id', $quest->id)->get() as $value)
                            {{$value->field->name}}: <i>true</i><br>
                            @empty
                            <i>None</i>
                            @endforelse

                            <strong>Associate a Values</strong><br>
                                @foreach($question->variables as $qv)
                                    <i>{{$qv->name}}</i>
                                    <select id="v-{{$qv->id}}-q-{{$quest->id}}" name="question_variable" class="form-control">
                                            <option value="">Select One</option>
                                        @foreach($qv->fields as $field)
                                            <option value="{{$field->id}}">{{$field->name}}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-xs" onclick="saveVarVal({{$qv->id}}, {{$quest->id}}); return false;">Save</button><br>
                                @endforeach
                            @endif
                            <hr>
                            <form method="POST" action="/question/{{$quest->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <a class="btn btn-primary" href="/question/{{$quest->id}}/edit">Edit</a>

                                <button type="submit" class="btn btn-danger btn-mini">Delete</button>
                            </form>
                            
                        </div>
                    </div>
                @endforeach


                <div class="col-sm-5">
                    <div class="well">
                        <h4>Add Associated Question</h4>
                            <form method="POST" action="/question/">
                                <input type="hidden" name="parent_id" value ="{{$question->id or 'null'}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" value="" class="form-control" name="question" placeholder="Ask your question...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Keywords</label>
                                    <textarea class="form-control" name="keywords"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class='btn btn-primary' value="Create Question">
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <chart></chart>
        </div>
    </div>

@stop


@section('js-foot')
    @if($question->responses()->count() > 0)
    <script>

    var cloud = document.getElementById('word-cloud');
    var fill = d3.scale.category20();
      d3.layout.cloud().size([300, 300])
          .words({!! \SMAHTCity\SMS311::questionWords($question->id) !!}.map(function(d) {
            return {text: d, size: 10 + Math.random() * 90};
          }))
          .padding(5)
          .rotate(function() { return ~~(Math.random() * 2) * 90; })
          .font("Impact")
          .fontSize(function(d) { return d.size; })
          .on("end", draw)
          .start();
      function draw(words) {
        d3.select("#word-cloud").append("svg")
            .attr("width", 300)
            .attr("height", 300)
          .append("g")
            .attr("transform", "translate(150,150)")
          .selectAll("text")
            .data(words)
          .enter().append("text")
            .style("font-size", function(d) { return d.size + "px"; })
            .style("font-family", "Impact")
            .style("fill", function(d, i) { return fill(i); })
            .attr("text-anchor", "middle")
            .attr("transform", function(d) {
            return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
            })
            .text(function(d) { return d.text; });
      }

    </script>
    @endif

    <script>
    function attachVariable()
    {
        var variable = document.getElementById('variable_id').value;
        var question = {{$question->id}};
        var url = '/variable/attach/' + question + '/' + variable;
            
        $.ajax({
              url: url,
              type: "GET",
            }).done(function( item ) {
              $('#variable-list').removeClass('hidden');
            $( item ).appendTo("#variables");
            });

       
    }

    function saveVarVal(varID, quesID)
    {   
        var calledId = 'v-' + varID + '-q-' + quesID;
        var fieldID = document.getElementById(calledId).value;
        var url = '/variable/attach-value/' + varID + '/' + quesID + '/' + fieldID;  
        var content = {"_token": "{{ csrf_token() }}"};

        $.ajax({
            url: url,
            type: "POST",
            data: content
        })

    }
    </script>


@stop