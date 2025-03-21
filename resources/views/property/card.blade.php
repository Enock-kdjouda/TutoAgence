<div class="card">
    <div class="card-body">
        @if ($property->image)
            <img src="{{$property->imageUrl()}}" style="width: 100%; height: 200% ; object-fit: cover" alt="">
        @endif
        <h5 class="card-title">
            <a href="{{route('property.show', ['slug' => $property->getSlug(), 'property' => $property])}}">{{$property->title}}</a>
        </h5>
        <p class="card-text">
           {{ $property->surface }} m² -  {{ $property->city }} - {{ $property->postal_code }}
            <br>
            <div class="text-primary fw-bold" style="font-size: 1.4rem">
                {{ number_format($property->price, thousands_separator: '') }} €
            </div>
        </p>
    </div>
</div>