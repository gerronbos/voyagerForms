@extends('voyager::master')

@section('page_title', "Voyager - Custom Formulieren")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Formulieren
        @can('add',$model_name)
            <a href="{{route("voyager.form.create")}}" class="btn btn-success">
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
        <table class="table table-borderd">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Autheur</th>
                <th>Actions</th>
            </tr>
            @foreach($forms as $form)
                <tr>
                    <td>{{$form->name}}</td>
                    <td>{{$form->email}}</td>
                    <td>{{$form->author}}</td>
                    <td class="no-sort no-click bread-actions">
                        @can('delete', $form)
                            <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $form->id }}">
                                <i class="voyager-trash"></i> {{ __('voyager.generic.delete') }}
                            </div>
                        @endcan
                        @can('edit', $form)
                            <a href="{{route("voyager.form.edit",[$form->id])}}" class="btn btn-sm btn-primary pull-right edit">
                                <i class="voyager-edit"></i> {{ __('voyager.generic.edit') }}
                            </a>
                        @endcan
                        {{-- @can('read', $form)
                            <a href="" class="btn btn-sm btn-success pull-right">
                                <i class="voyager-list"></i> {{ __('voyager.generic.view') }}
                            </a>
                        @endcan --}}
                    </td>
                </tr>
            @endforeach
        </table>

    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager.generic.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager.generic.delete_question') }} Formulier?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.form.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                 value="{{ __('voyager.generic.delete_confirm') }} Formulier">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager.generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
<script>
    var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id') + "/delete";
            console.log(form.action);

            $('#delete_modal').modal('show');
        });
</script>
@stop
