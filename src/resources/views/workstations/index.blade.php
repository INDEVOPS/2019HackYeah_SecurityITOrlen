@extends('layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8 col-md-9">
            <h1>Lista stacji</h1>
        </div>
        <div class="col-4 col-md-3 text-right">
            <a class="align-middle btn btn-info" href="{{ action('WorkstationController@create') }}">
                <i class="fas fa-stethoscope mr-2"></i> Zbadaj stację
            </a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Hostname</th>
                <th scope="col" class="text-center">Błędy</th>
                <th scope="col" class="text-center">Ostrzeżenia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workstations as $workstation)
                <?php
                    $class = '';

                    if($workstation->warnings > 0)
                        $class = 'table-warning';
                    
                    if($workstation->errors > 0)
                        $class = 'table-danger';
                ?>
                <tr class="{{ $class }}">
                    <td>
                        <a href="{{ action('WorkstationController@show', ['workstation' => $workstation]) }}">
                            {{ $workstation->FQDN }}
                        </a>
                    </td>
                    <td class="text-center">{{ $workstation->errors }}</td>
                    <td class="text-center">{{ $workstation->warnings }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
@endsection