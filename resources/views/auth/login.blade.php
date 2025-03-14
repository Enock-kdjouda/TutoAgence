@extends('base')

@section('title','se connecter')

@section('content')

    <div class=" mt-4 container">
        <h1>@yield('title')</h1>
        @include('shared.flash')
        <form method="POST" action="{{ route('auth.login') }}" class="vstak gap-2">
            @csrf
            
                @include('shared.input', ['label' => 'Email' , 'name' => 'email' , 'type' => 'email','class' => 'col'])
                @include('shared.input', ['label' => 'Mot de passe' , 'name' => 'password' , 'type' => 'password','class' => 'col'])
           
           
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </div>
        </form>
@endsection