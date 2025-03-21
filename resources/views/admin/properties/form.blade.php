@extends('admin.admin')

@section('title' , $property -> exists ? "Editer un bien" : "Créer un bien")

@section('content')

    <h1>@yield('title')</h1>
    <form method="POST" class="vstak gap-y-2" action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store' , $property) }}" enctype="multipart/form-data">
    @csrf
    @method($property->exists? 'PUT' : 'POST')

    <div class="row">
    @include('shared.input', ['label' => 'Image' , 'name' => 'image' , 'type' => 'file'])

        @include('shared.input', ['label' => 'Titre' , 'name' => 'title' , 'value' => $property->title])
    
        <div class="col row">
            @include('shared.input', ['class' => 'col'  , 'name' => 'surface' , 'value' => $property->surface])
            @include('shared.input', ['class' => 'col' , 'label' => 'Prix' , 'name' => 'price' , 'value' => $property->price])
        </div>
    </div>
    @include('shared.input', [ 'type' => 'textarea'  , 'name' => 'description' , 'value' => $property->desciption])
    <div class="row">
        @include('shared.input', ['class' => 'col' , 'label' => 'Pièces' , 'name' => 'rooms' , 'value' => $property->rooms])
        @include('shared.input', ['class' => 'col' , 'label' => 'Chambres' , 'name' => 'bedrooms' , 'value' => $property->bedrooms])
        @include('shared.input', ['class' => 'col' , 'label' => 'Étage' , 'name' => 'floor' , 'value' => $property->floor])
    </div>
    <div class="row">
        @include('shared.input', ['class' => 'col' , 'label' => 'Ville' , 'name' => 'city' , 'value' => $property->city])
        @include('shared.input', ['class' => 'col' , 'label' => 'Adresse' , 'name' => 'address' , 'value' => $property->address])
        @include('shared.input', ['class' => 'col' , 'label' => 'Code postal' , 'name' => 'postal_code' , 'value' => $property->postal_code])
    </div>
    @include('shared.select', ['label' => 'Options' , 'name' => 'options[]' , 'value' => $property->options()->pluck('id'),'multiple' => true])
    @include('shared.checkbox', [ 'label' => 'Vendu' , 'name' => 'sold' , 'value' => $property->sold,'options' => $options])
      
    <div>
        <button class="btn btn-primary">
            @if($property->exists)
                 Modifier
            @else 
                 Créer 
            @endif
        </button>
    </div>
@endsection