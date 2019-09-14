@extends('layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8 col-md-9">
            <h1>Wzorce</h1>
        </div>
        <div class="col-4 col-md-3 text-right">
            <a class="align-middle btn btn-success" href="{{ action('TemplateController@create') }}">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <hr>
    

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <th scope="col" style="width: 200px;">Regex</th>
                <th scope="col">Opcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($templates as $template)
                <tr>
                    <td>{{ $template->name }}</td>
                    <td>
                        <kbd>{{ $template->regex }}</kbd>
                    </td>
                    <td>
                        <a class="align-middle btn btn-sm btn-info" href="{{ action('TemplateController@edit', ['template' => $template]) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection