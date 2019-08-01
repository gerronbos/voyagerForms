@extends('voyager::master')

@section('page_title', "Voyager - Custom Formulieren")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Formulieren items
    </h1>
@stop

@section("css")

@stop

@section('content')
    <div class="container-fluid">
        @include('voyager::alerts')
        @if(config('voyager.show_dev_tips'))
        <div class="alert alert-info">

        </div>
        @endif
    </div>

    <div class="page-content settings container-fluid">
        {!! Form::open() !!}
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="form-group">
                    {!! Form::label("name","Title") !!}
                    {!! Form::text("name",$field->name,["class"=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("type","Type") !!}
                    <select class="form-control" name="type">
                        <option value="text" @if($field->type == "text") selected @endif>Textveld (1 regel)</option>
                        <option value="textarea" @if($field->type == "textarea") selected @endif>Textveld (meerdere regels)</option>
                        <option value="select" @if($field->type == "select") selected @endif>Dropdown</option>
                        <option value="radiobutton" @if($field->type == "radiobutton") selected @endif>Radiobuttons (1 antwoord mogelijk)</option>
                        <option value="checkbox" @if($field->type == "checkbox") selected @endif>Checkboxes (meerdere antwoorden mogelijk)</option>
                    </select>
                </div>
                <div class="options" style="width:20%;">
                    <button type="button" class="btn btn-primary btn-sm add_answer">Antwoord mogelijkheid toevoegen</button>
                    <div id="elements">
                        @if(!is_array($field->options))
                            <input type="text" class="form-control" name="answers[]">
                        @else
                            @foreach($field->options["answers"] as $id=>$answer)
                                @if($id == 0)
                                    <input type="text" class="form-control" name="answers[]" value="{{$answer}}">
                                @else
                                    <span class="span_values" data-answer="{{$answer}}"></span>
                                @endif
                            @endforeach
                        @endif
                        
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label("required","Required") !!}
                    <input type="checkbox" name="required" value="1" @if($field->required) checked @endif>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary save">{{ __('voyager.generic.save') }}</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>


@stop

@section('javascript')
<script>
$("[name='type']").on('change',function(){
    checkType();
});
checkType();

function checkType(){
    if($("[name='type']").val() !== "text" && $("[name='type']").val() !== "textarea"){
        $(".options").show();
    }
    else{
        $(".options").hide();
    }
}

$(".span_values").each(function(index,el){
    addAnswer($(el).data("answer"));
});

function addAnswer(value){
    var input_group = document.createElement("div");
    input_group.className = "input-group";

    var input = document.createElement("input");
    input.type = "text";
    input.className = "form-control";
    input.name = "answers[]";
    input.value = value;

    input_group.append(input);

    var span = document.createElement("span");
    span.className = "input-group-btn";

    var button = document.createElement("button");
    button.type = "button";
    button.className = "btn btn-danger";
    button.style.marginTop = "0";
    button.style.marginBottom = "0";
    button.style.fontSize = "13px";

    var button_span = document.createElement("span");
    button_span.className = "glyphicon glyphicon-trash";

    button.append(button_span);

    span.append(button);

    input_group.append(span);
    $("#elements").append(input_group);

    $(button).on("click",function(){
        $(input_group).remove();
    });
}

$(".add_answer").on("click",function(){
    addAnswer("");
});
</script>   
@stop
