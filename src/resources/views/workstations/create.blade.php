@extends('layout')

@section('content')
<div class="container">
    <h1>Zbadaj stację roboczą</h1>
    <hr>
    <form method="POST" action="{{ action('WorkstationController@store') }}" autocomplete="off">
        @if(isset($template))
            {{ method_field('PATCH') }}
        @endif

        @csrf

        <div class="form-group row align-items-center">
            <label for="hostname" class="col-sm-2 col-form-label">Hostname</label>
            <div class="col-sm-10">
                
                <input
                    type="text"
                    class="form-control{{ $errors->has('hostname') ? ' is-invalid' : '' }}"
                    id="hostname"
                    name="hostname"
                    placeholder="..."
                    required
                >
                
            </div>
        </div>

        <div class="form-group row align-items-center">
            <label class="col-sm-2 col-form-label">Login</label>
            <div class="col-sm-10">
                
                <input
                    type="text"
                    class="form-control"
                    placeholder="..."
                    required
                >
                
            </div>
        </div>

        <div class="form-group row align-items-center">
            <label class="col-sm-2 col-form-label">Hasło</label>
            <div class="col-sm-10">
                
                <input
                    type="password"
                    class="form-control"
                    placeholder="..."
                    required
                >
                
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">
                    Zbadaj
                </button>
            </div>
        </div>

    </form>
</div>
@endsection