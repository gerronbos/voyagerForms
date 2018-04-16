@extends('voyager::master')

@section('page_title', "Voyager - Custom Formulieren")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Formulieren
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
        @if($form->id)
            @include("voyagerForm::forms.partials.nav",["active" => "form"])
        @endif
        {!! Form::open() !!}
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="form-group">
                    {!! Form::label("name","Naam") !!}
                    {!! Form::text("name",$form->name,["class"=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("email","Email") !!}
                    {!! Form::text("email",$form->email,["class"=>"form-control"]) !!}
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
