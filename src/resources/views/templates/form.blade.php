@extends('layout')

@section('content')
<div class="container">

    <?php
        $title = 'Dodawanie wzorca';
        $form_action = action('TemplateController@store');
        
        if(isset($template)) {
            $title = 'Edycja wzorca';
            $form_action = action('TemplateController@update', [
                'template' => $template
            ]);
        }

        $custom_sections = [
            'Główne informacje' => [
                'name' => [
                    'label' => 'Nazwa',
                    'type'  => 'text',
                ],
                'description' => [
                    'label' => 'Opis',
                    'type'  => 'textarea',
                ],
                'regex' => [
                    'label' => 'Wzorzec (regex)',
                    'type'  => 'text',
                ],
            ]
        ];

        //$sections = [
            // [
            //     'label' => 'Zapora sieciowa',
            //     'inputs' => [
            //         'port' => [
            //             'label' => 'Porty przepuszczane',
            //             'type'  => 'text',
            //         ],
            //     ]
            // ],
            // [
            //     'label' => 'Konta lokalne',
            //     'inputs' => [
            //         'account' => [
            //             'label' => 'Nazwa',
            //             'type'  => 'text',
            //         ],
            //         'administrator' => [
            //             'label' => 'Administrator',
            //             'type'  => 'checkbox',
            //         ],
            //         'account_status' => [
            //             'label' => 'Włączone',
            //             'type'  => 'checkbox',
            //         ],
            //     ]
            // ],
            // [
            //     'label' => 'Usługi',
            //     'inputs' => [
            //         'service' => [
            //             'label' => 'Nazwa usługi',
            //             'type'  => 'text',
            //         ],
            //         'service_on' => [
            //             'label' => 'Usługa włączona',
            //             'type'  => 'checkbox',
            //         ],
            //     ]
            // ],
            // [
            //     'label' => 'Aplikacje',
            //     'inputs' => [
            //         'application' => [
            //             'label' => 'Nazwa aplikacji',
            //             'type'  => 'text',
            //         ],
            //         'aplication_on' => [
            //             'label' => 'Aplikacja jest uruchomiana',
            //             'type'  => 'checkbox',
            //         ],
            //     ]
            // ],
       //];
    ?>

    <h1>{{ $title }}</h1>
    <hr>

    <form method="POST" action="{{ $form_action }}" autocomplete="off">
        @if(isset($template))
            {{ method_field('PATCH') }}
        @endif

        @csrf


        @foreach(array_merge($custom_sections, \App\Workstation::paramSections()) as $section => $parametes)
            <h3>{{ $section }}</h3>
            <hr>

            @foreach($parametes as $param => $options)

                <div class="form-group row align-items-center">
                    <label for="{{ $param }}" class="col-sm-2 col-form-label">{{ $options['label'] }}</label>
                    <div class="col-sm-10">
                        <?php
                            $value = '';

                            if(isset($template)){
                                $value = $template->getAttribute($param);
                            }
                        ?>

                        @if($options['type'] == 'text')
                        <input
                            type="text"
                            class="form-control{{ $errors->has($param) ? ' is-invalid' : '' }}"
                            id="{{ $param }}"
                            name="{{ $param }}"
                            placeholder="..."
                            value="{{ $value }}"
                            required
                        >
                        @endif

                        @if($options['type'] == 'number')
                        <input
                            type="number"
                            class="form-control{{ $errors->has($param) ? ' is-invalid' : '' }}"
                            id="{{ $param }}"
                            name="{{ $param }}"
                            min="1"
                            placeholder="..."
                            value="{{ $value }}"
                            required
                        >
                        @endif

                        @if($options['type'] == 'textarea')
                        <textarea
                            class="form-control{{ $errors->has($param) ? ' is-invalid' : '' }}"
                            style="min-height:100px;"
                            id="{{ $param }}"
                            name="{{ $param }}"
                            placeholder="..."
                            required
                        >{{ $value }}</textarea>
                        @endif

                        @if($options['type'] == 'boolean')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="{{ $param }}" id="{{ $param }}-true" value="1" required <?php if($value == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="{{ $param }}-true">Tak</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="{{ $param }}" id="{{ $param }}-false" value="0" <?php if($value === 0) echo 'checked'; ?>>
                                <label class="form-check-label" for="{{ $param }}-false">Nie</label>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach

        @endforeach

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">
                    @isset($template) Zapisz @else Dodaj @endisset
                </button>
            </div>
        </div>
        
    </form>

</div>
@endsection