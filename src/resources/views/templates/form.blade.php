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

        $sections = [
            [
                'label' => 'Główne informacje',
                'inputs' => [
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
                ],
            ],
            [
                'label' => 'System',
                'inputs' => [
                    'cpu' => [
                        'label' => 'Procesory',
                        'type'  => 'text',
                    ],
                    'ram' => [
                        'label' => 'Pamięć [GB]',
                        'type'  => 'text',
                    ],
                    'disk' => [
                        'label' => 'Zasób [GB]',
                        'type'  => 'text',
                    ],
                    
                ]
            ],
            [
                'label' => 'Interfejsy sieciowe',
                'inputs' => [
                    'lan' => [
                        'label' => 'Włączone',
                        'type'  => 'checkbox',
                    ],
                    'mask' => [
                        'label' => 'Maska podsieci',
                        'type'  => 'text',
                    ],
                    'gateway' => [
                        'label' => 'Brama podsieci',
                        'type'  => 'text',
                    ],
                    'dns' => [
                        'label' => 'Domain Name Server',
                        'type'  => 'text',
                    ],
                ]
            ],
            [
                'label' => 'Konta lokalne',
                'inputs' => [
                    'account' => [
                        'label' => 'Nazwa',
                        'type'  => 'text',
                    ],
                    'administrator' => [
                        'label' => 'Administrator',
                        'type'  => 'checkbox',
                    ],
                    'account_status' => [
                        'label' => 'Włączone',
                        'type'  => 'checkbox',
                    ],
                ]
            ],
            [
                'label' => 'Urządzenia',
                'inputs' => [
                    'usb' => [
                        'label' => 'Usb dozwolone',
                        'type'  => 'checkbox',
                    ],
                    'cd' => [
                        'label' => 'Stacja dysków dozwolona',
                        'type'  => 'checkbox',
                    ],
                    'mouse' => [
                        'label' => 'Myszka podłączona',
                        'type'  => 'checkbox',
                    ],
                    'Klawiatura ' => [
                        'label' => 'Klawiatura podłączona',
                        'type'  => 'checkbox',
                    ],
                ]
            ],
            [
                'label' => 'Poprawki systemu operacyjnego',
                'inputs' => [
                    'os_update' => [
                        'label' => 'Nazwa ostatniej poprawki',
                        'type'  => 'text',
                    ],
                ]
            ],
            [
                'label' => 'Usługi',
                'inputs' => [
                    'service' => [
                        'label' => 'Nazwa usługi',
                        'type'  => 'text',
                    ],
                    'service_on' => [
                        'label' => 'Usługa włączona',
                        'type'  => 'checkbox',
                    ],
                ]
            ],
        ];
    ?>

    <h1>{{ $title }}</h1>
    <hr>

    <form method="POST" action="{{ $form_action }}" autocomplete="off">
        @if(isset($template))
            {{ method_field('PATCH') }}
        @endif

        @foreach($sections as $section)
            <h3>{{ $section['label'] }}</h3>
            <hr>

            @foreach($section['inputs'] as $key => $input)
            
                <div class="form-group row align-items-center">
                    <label for="{{ $key }}" class="col-sm-2 col-form-label">{{ $input['label'] }}</label>
                    <div class="col-sm-10">
                        
                        @if($input['type'] == 'text')
                        <input
                            type="text"
                            class="form-control{{ $errors->has($key) ? ' is-invalid' : '' }}"
                            id="{{ $key }}"
                            name="{{ $key }}"
                            placeholder="..."
                            value=""
                        >
                        @endif

                        @if($input['type'] == 'textarea')
                        <textarea
                            class="form-control{{ $errors->has($key) ? ' is-invalid' : '' }}"
                            style="min-height:200px;"
                            id="{{ $key }}"
                            name="{{ $key }}"
                            placeholder="..."
                        ></textarea>
                        @endif

                        @if($input['type'] == 'checkbox')
                        <input
                            type="checkbox"
                            class="form-control{{ $errors->has($key) ? ' is-invalid' : '' }}"
                            id="{{ $key }}"
                            name="{{ $key }}"
                        >
                        @endif

                    </div>
                </div>

            @endforeach

        @endforeach
        
    </form>

</div>
@endsection