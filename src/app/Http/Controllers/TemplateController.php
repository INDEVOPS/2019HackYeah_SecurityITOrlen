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
        //
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
