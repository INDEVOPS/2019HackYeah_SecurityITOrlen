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

    <hr>

    <!-- <table class="table">
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
    </table> -->

    <div class="row">
    @foreach($workstations as $workstation)
        <?php
            $class = 'bg-success';

            if($workstation->warnings > 0)
                $class = 'bg-warning';
            
            if($workstation->errors > 0)
                $class = 'bg-danger';
        ?>

        <div class="col-xd-6 col-md-4 col-lg-3">
            <div class="card {{ $class }}">
                <div class="card-header text-white">
                    {{ $workstation->FQDN }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Błędy: {{ $workstation->errors }}<br>Ostrzeżenia: {{ $workstation->warnings }}
                    </li>
                    <li class="list-group-item text-right">
                        <a href="{{ action('WorkstationController@show', ['workstation' => $workstation]) }}" class="card-link btn btn-info btn-sm"><i class="fas fa-bug mr-1"></i>Szczegóły</a>
                    </li>
                </ul>
            </div>
        </div>
    
    @endforeach
    </div>


    

</div>
@endsection