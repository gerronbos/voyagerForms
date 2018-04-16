@extends('voyager::master')

@section('page_title', "Voyager - Custom Formulieren")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Formulieritems van <span style="font-style: italic">{{$form->name}}</span>
        @can('add',$model_name)
            <a href="{{route("voyager.form.items.add",[$form->id])}}" class="btn btn-success">
                <i class="voyager-plus"></i> {{ __('voyager.generic.add_new') }}
            </a>
        @endcan
    </h1>
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
        @include("voyagerForm::forms.partials.nav",["active" => "fields"])

        <table class="table table-borderd">
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Required</th>
                <th>Actions</th>
            </tr>
            @if(!count($fields))
                <td colspan="10">
                    Er zijn nog geen velden toegevoegd.
                </td>
            @else
                @foreach($fields as $field)
                    <tr>
                        <td>{{$field->name}}</td>
                        <td>{{$field->type}}</td>
                        <td>{{$field->required}}</td>
                        <td class="no-sort no-click bread-actions">
                            @can('delete', $form)
                                <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $form->id }}">
                                    <i class="voyager-trash"></i> {{ __('voyager.generic.delete') }}
                                </div>
                            @endcan
                            @can('edit', $form)
                                <a href="{{route("voyager.form.items.edit",[$form->id,$field->id])}}" class="btn btn-sm btn-primary pull-right edit">
                                    <i class="voyager-edit"></i> {{ __('voyager.generic.edit') }}
                                </a>
                            @endcan
                            @can('edit', $form)
                                <div class="btn-group pull-right">
                                    <button type="button" @if($field->row == 1) disabled="disabled" @endif class="btn btn-default row_up" data-id="{{$field->id}}"><span class="glyphicon glyphicon-arrow-up"></span> </button>
                                    <button type="button" @if($field->row == count($fields)) disabled="disabled" @endif class="btn btn-default row_down" data-id="{{$field->id}}"><span class="glyphicon glyphicon-arrow-down"></span></button>
                                </div>
                            @endcan

                        </td>
                    </tr>
                @endforeach
            @endif
        </table>

    </div>

{!! Form::open(["id"=>"change_row_form"]) !!}
<input type="hidden" name="direction" id="change_row_direction">
{!! Form::close() !!}
@stop

@section('javascript')
<script>
    var url = "{{route("voyager.form.items.changerow",[$form->id,":ID"])}}"
    $(".row_up").click(function(){
        $("#change_row_direction").val("up");
        $("#change_row_form").attr("action",url.replace(":ID",$(this).attr("data-id")));
        $("#change_row_form").submit()

    });
    $(".row_down").click(function(){
        $("#change_row_direction").val("down");
        $("#change_row_form").attr("action",url.replace(":ID",$(this).attr("data-id")));
        $("#change_row_form").submit()
    });
</script>

@stop
