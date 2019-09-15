<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();

        return view('templates/index', [
            'templates' => $templates
        ]);
    }

    public function create()
    {
        return view('templates/form');
    }

    public function store(Request $request)
    {
        $template = new Template();

        // Template related stuff
        $template->name = $request->input('name');
        $template->description = $request->input('description');
        $template->regex = $request->input('regex');

        // Parameters
        foreach(\App\Workstation::params() as $param => $options){
            $template->setAttribute($param, $request->input($param));
        }

        $template->save();

        return redirect()->action('TemplateController@index');
    }

    public function show(Template $template)
    {
        // TODO: Remove
    }

    public function edit(Template $template)
    {
        return view('templates/form', [
            'template' => $template,
        ]);
    }

    public function update(Request $request, Template $template)
    {
        // Template related stuff
        $template->name = $request->input('name');
        $template->description = $request->input('description');
        $template->regex = $request->input('regex');

        // Parameters
        foreach(\App\Workstation::params() as $param => $options){
            if($request->has($param))
                $template->setAttribute($param, $request->input($param));
        }

        $template->save();

        return redirect()->action('TemplateController@index');
    }

    public function destroy(Template $template)
    {
        // TODO
    }
}
