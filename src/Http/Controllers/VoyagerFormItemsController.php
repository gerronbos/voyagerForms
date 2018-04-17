<?php
namespace Hostingprecisie\VoyagerForm\Http\Controllers;

use App\User;
use Hostingprecisie\VoyagerForm\Models\FormFields;
use Hostingprecisie\VoyagerForm\ServiceProviders\VoyagerFormItemServiceProvider;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Hostingprecisie\VoyagerForm\Models\Form;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use View,Auth,Redirect;

class VoyagerFormItemsController extends VoyagerBreadController
{

    public function browse(User $user)
    {
        $view = "voyagerForm::forms.index";
        $forms = Form::orderBy("name",'asc')->get();

        return Voyager::view($view, compact(
            'forms'
        ));
    }

    public function edit(Request $request, $id)
    {
        $view = "voyagerForm::forms.items.add-edit";
        $field = FormFields::find($request->route()->parameter("field_id"));

        return Voyager::view($view, compact(
            'field'
        ));
    }
    public function postEdit(Request $request, $id)
    {
        $field = FormFields::find($request->route()->parameter("field_id"));
        $field->name = $request->input("name");
        $field->type = $request->input("type");
        $field->required = ($request->input("required")) ? $request->input("required") : 0;
        $field->save();

        return Redirect::route("voyager.form.items",[$id])->with([
            'message'    => __('voyager.generic.successfully_updated')." Formulier veld",
            'alert-type' => 'success',
        ]);
    }
    public function add()
    {
        $view = "voyagerForm::forms.items.add-edit";
        $field = new FormFields();

        return Voyager::view($view, compact(
            'field'
        ));
    }
    public function postAdd(Request $request)
    {
        $field = new FormFields();
        $field->name = $request->input("name");
        $field->type = $request->input("type");
        $field->required = ($request->input("required")) ? $request->input("required") : 0;
        $field->form_id = $request->route()->parameter("id");
        $field->row = FormFields::where("form_id","=",$request->route()->parameter("id"))->count() + 1;
        $field->save();

        return Redirect::route("voyager.form.items",[$request->route()->parameter("id")])->with([
            'message'    => __('voyager.generic.successfully_added_new')." Formulier veld",
            'alert-type' => 'success',
        ]);
    }

    public function delete(User $user,$id,$field_id)
    {
        $field = FormFields::find($field_id);
        $field->delete();

        return Redirect::route("voyager.form.items",[$id])->with([
            'message'    => __('voyager.generic.successfully_deleted')." Formulier veld",
            'alert-type' => 'success',
        ]);
    }

    public function index(Request $request){
        $view = "voyagerForm::forms.items.index";
        $form = Form::find($request->route()->parameter("id"));
        $fields = $form->fields()->orderBy("row")->get();
        $model_name = Form::class;

        return Voyager::view($view, compact(
            'form',
            "model_name",
            "fields"
        ));
    }

    public function changerow(Request $request){

        VoyagerFormItemServiceProvider::changeRow(FormFields::find($request->route()->parameter("field_id")),$request->input("direction"));

        return Redirect::route("voyager.form.items",[$request->route()->parameter("id")])->with([
            'message'    => __('voyager.generic.successfully_updated')." Formulier veld",
            'alert-type' => 'success',
        ]);

    }
}