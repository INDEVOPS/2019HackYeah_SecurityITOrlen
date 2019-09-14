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

        $template->name = $request->input('name');
        $template->description = $request->input('description');
        $template->regex = $request->input('regex');

        $template->cpu = $request->input('cpu');
        $template->ram = $request->input('ram');
        $template->hdd = $request->input('hdd');

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
        // TODO
    }

    public function destroy(Template $template)
    {
        // TODO
    }
}
