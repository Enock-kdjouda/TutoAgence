@extends('base')

@section('content')

    <!-- <x-alert type="success" class="fw-bold" >
        Des informations
    </x-alert> -->
   <!-- <x-component-weather></x-component-weather> -->
    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence Immo</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
             Aspernatur aliquam facilis eos magni unde consequatur eaque quas sint qui maxime! Distinctio saepe, libero tempore ullam provident eaque optio vitae iste. Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, impedit corporis? Laboriosam iusto libero eligendi quod expedita similique numquam sequi repudiandae, maiores non, quidem delectus?
            </p>
        </div>
    </div> 
    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property)
                <div class="col">
                    @include('property.card')
                </div>
            @endforeach
        </div>   
    </div>
@endsection