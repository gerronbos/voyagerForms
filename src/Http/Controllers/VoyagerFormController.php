<?php
namespace Hostingprecisie\VoyagerForm\Http\Controllers;

use App\User;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Hostingprecisie\VoyagerForm\Models\Form;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use View,Auth;
use Illuminate\Support\Facades\Redirect;

class VoyagerFormController extends VoyagerBreadController
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
        $view = "voyagerForm::forms.add-edit";
        $form = Form::find($id);

        return Voyager::view($view, compact(
            'form'
        ));
    }
    public function postEdit(Request $request, $id){
        $form = Form::find($id);
        $form->name = $request->input("name");
        $form->email = $request->input("email");
        $form->save();

        return Redirect::route("voyager.form.index")->with([
            'message'    => __('voyager.generic.successfully_updated')." Formulier",
            'alert-type' => 'success',
        ]);
    }
    public function add()
    {
        $view = "voyagerForm::forms.add-edit";
        $form = new Form();

        return Voyager::view($view, compact(
            'form'
        ));
    }

    public function postAdd(Request $request){
        $form = new Form();
        $form->name = $request->input("name");
        $form->email = $request->input("email");
        $form->author = Auth::user()->id;
        $form->save();

        return Redirect::route("voyager.form.items",[$form->id])->with([
            'message'    => __('voyager.generic.successfully_added_new')." Formulier",
            'alert-type' => 'success',
        ]);
    }


    public function delete(User $user, $id)
    {
        $form = Form::find($id);
        foreach($form->fields as $item){
            $item->delete();
        }
        $form->delete();

        return Redirect::route("voyager.form.index")->with([
            'message'    => __('voyager.generic.successfully_deleted')." Formulier",
            'alert-type' => 'success',
        ]);
    }

    public function index(Request $request){
        $view = "voyagerForm::forms.index";
        $forms = Form::orderBy("name",'asc')->get();
        $model_name = Form::class;

        return Voyager::view($view, compact(
            'forms',
            "model_name"
        ));
    }
}