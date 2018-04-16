@extends('voyager::master')

@section('page_title', "Voyager - Custom Formulieren")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Formulieren items
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
        {!! Form::open() !!}
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="form-group">
                    {!! Form::label("name","Name") !!}
                    {!! Form::text("name",$field->name,["class"=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("type","Type") !!}
                    <select class="form-control" name="type">
                        <option value="text">Textveld</option>
                    </select>
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

@stop
