<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    body {
        padding: 10px;
    }
    </style>
</head>
<body>
    <div id="app">
        <main class="container">
            <h1>Raport <small style="font-size: 0.6em;">Wygenerowano: <?php echo date("d.m.Y"); ?></small></h1>
            <hr>

            @foreach($workstations as $workstation)

            <h2 class="mt-5">{{ $workstation->FQDN }} <small style="font-size: 0.6em;"><?php if($workstation->template != null) echo 'Wzorzec: '.$workstation->template->name; ?></small></h2>
            <table class="table" style="page-break-after: always;">
        <thead>
            <tr>
                <th scope="col">Parametr</th>
                <th scope="col" class="text-center">Stan</th>
                <th scope="col" class="text-center">Wzorzec</th>
            </tr>
        </thead>
        <tbody>

            @foreach(\App\Workstation::paramSections() as $section => $parametes)
                <tr>
                    <th colspan=3 class="pt-4 pb-1">{{ $section }}</th>
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

                        $status = $workstation->getParamStatus($param);
                        $class = '';

                        if($status == 1)
                            $class = 'table-warning';

                        if($status == 2)
                            $class = 'table-danger';

                        $tips = $workstation->getParamTips($param);
                    ?>

                    <tr class="{{ $class }}">
                        <td>
                            {{ $options['label'] }}
                            @if($tips != null)
                                <br><small><i class="far fa-lightbulb mr-1" style="font-size: 1.2em;"></i> {{ $tips }}</small>
                            @endif
                        </td>
                        <td class="text-center">{{ $current_value }}</td>
                        <td class="text-center">{{ $template_value }}</td>
                    </tr>
                
                @endforeach

            @endforeach

        </tbody>
    </table>

            @endforeach
        </main>
    </div>
</body>
</html>