@extends('admin.admin')

@section('title' , $option -> exists ? "Editer un option" : "Créer un option")

@section('content')

    <h1>@yield('title')</h1>
    <form method="POST" class="vstak gap-y-2" action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store' , $option) }}">
    @csrf
    @method($option->exists? 'PUT' : 'POST')

    <div class="row">
        @include('shared.input', ['label' => 'Nom' , 'name' => 'name' , 'value' => $option->name])
    </div>
      
    <div>
        <button class="btn btn-primary">
            @if($option->exists)
                 Modifier
            @else 
                 Créer 
            @endif
        </button>
    </div>
@endsection