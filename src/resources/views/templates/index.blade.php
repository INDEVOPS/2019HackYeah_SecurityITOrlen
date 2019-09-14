@extends('layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8 col-md-9">
            <h1>Wzorce</h1>
        </div>
        <div class="col-4 col-md-3 text-right">
            <a class="align-middle btn btn-lg btn-success" href="{{ action('TemplateController@create') }}">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <hr>
    ...
</div>
@endsection