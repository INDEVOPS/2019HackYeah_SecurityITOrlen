@extends('layout')

@section('content')
<div class="container">
    <h1>{{ $hostname }} <small style="font-size: 0.6em;">Badanie maszyny</small></h1>
    <hr>
    
    <div class="text-center">
        <div class="spinner-border text-dark" role="status" style="width: 4rem; height: 4rem;">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</div>
@endsection