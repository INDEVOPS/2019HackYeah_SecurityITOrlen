@extends('layout')

@section('content')
<div class="container">
    <h1>{{ $workstation->FQDN }} <small style="font-size: 0.6em;"><?php if($workstation->template != null) echo 'Wzorzec: '.$workstation->template->name; ?></small></h1>

    @if( $workstation->template == null )
    
        <div class="alert alert-warning" role="alert">
            <b>Błąd:</b> Do tej maszyny nie pasuje żaden wzorzec!
        </div>

    @endif

    <?php

        $sections = [
            'Konfiguracja' => [
                'cpu' => 'Procesory [vCPU]',
                'ram' => 'Pamięć [GB]',
                'hdd' => 'Dysk [GB]'
            ]
        ];
    
    ?>

    

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Parametr</th>
                <th scope="col" class="text-center">Stan</th>
                <th scope="col" class="text-center">Wzorzec</th>
            </tr>
        </thead>
        <tbody>

            <!-- @foreach($sections as $section => $parametes)

                

                @foreach($parametes as $param => $label)

                <?php
                    $current_value = $workstation->getAttribute($param);
                    $template_value = '-';
                    $class = '';

                    if($workstation->template != null) {
                        $template_value = $workstation->template->getAttribute($param);

                        if($current_value < $template_value)
                            $class = 'table-danger';
                        else if ($current_value > $template_value)
                            $class = 'table-warning';
                    }
                ?>
                
                <tr class="{{ $class }}">
                    <td>{{ $label }}</td>
                    <td class="text-center">{{ $current_value }}</td>
                    <td class="text-center">{{ $template_value }}</td>
                </tr>

                @endforeach
                
            @endforeach -->

            @foreach(\App\Workstation::paramSections() as $section => $parametes)
                <tr>
                    <th colspan=3 class="pt-5 pb-3">{{ $section }}</th>
                </tr>
                
                @foreach($parametes as $param => $options)

                    <?php
                        $current_value = $workstation->getAttribute($param);
                        $template_value = '-';

                        if($workstation->template != null) {
                            $template_value = $workstation->template->getAttribute($param);
                        }

                        if($options['type'] == 'boolean'){
                            $current_value = $current_value ? 'Tak' : 'Nie';

                            if($template_value !== '-')
                                $template_value = $template_value ? 'Tak' : 'Nie';
                        }
                    ?>

                    <tr class="">
                        <td>{{ $options['label'] }}</td>
                        <td class="text-center">{{ $current_value }}</td>
                        <td class="text-center">{{ $template_value }}</td>
                    </tr>
                
                @endforeach

            @endforeach

        </tbody>
    </table>

</div>
@endsection