@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="well">
                <a class="btn btn-primary pull-right" href="/question/{{$question->parent_id}}">Edit Parent Question</a>

                <h3>Edit Question</h3>
                <form method="POST" action="/question/{{$question->id}}">
                    <input type="hidden" name="_method" value ="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-lg-10">
            <div class="row">



                @foreach($children as $qest)
                    <div class="col-sm-5">
                        <div class="well">
                        <h4>{{$qest->question}}</h4>
                        <p>{{$qest->keywords}}</p>
                            <form method="POST" action="/question/{{$qest->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <a class="btn btn-primary" href="/question/{{$qest->id}}/edit">Edit</a>

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
    var fill = d3.scale.category20();
      d3.layout.cloud().size([900, 300])
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
        d3.select("body").append("svg")
            .attr("width", 900)
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


@stop