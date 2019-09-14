@extends('layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8 col-md-9">
            <h1>Wzorce</h1>
        </div>
        <div class="col-4 col-md-3 text-right">
            <a class="align-middle btn btn-success" href="{{ action('TemplateController@create') }}">
                <i class="fas fa-plus mr-2"></i> Dodaj
            </a>
        </div>
    </div>
    

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <th scope="col">Regex</th>
                <th scope="col" style="width: 190px;">Opcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($templates as $template)
                <tr>
                    <td>{{ $template->name }}<br><small>{{ $template->description }}</small></td>
                    <td>
                        <kbd>{{ $template->regex }}</kbd>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ action('TemplateController@edit', ['template' => $template]) }}">
                            <i class="fas fa-pencil-alt mr-2"></i> Edytuj
                        </a>

                        <button class="btn btn-sm btn-danger" disabled>
                            <i class="fas fa-trash mr-2"></i> Usuń
                        </button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection