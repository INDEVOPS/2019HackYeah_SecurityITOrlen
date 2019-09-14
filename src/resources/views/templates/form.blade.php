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
                'inputs' => []
            ],
            [
                'label' => 'Interfejsy sieciowe',
                'inputs' => []
            ],
            [
                'label' => 'Konta lokalne',
                'inputs' => []
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