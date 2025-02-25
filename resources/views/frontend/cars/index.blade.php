@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Available Cars</h1>
        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }} ({{ $car->brand }})</h5>
                            <p class="card-text">{{ $car->car_type }} | Year: {{ $car->year }}</p>
                            <p class="card-text">${{ $car->daily_rent_price }} per day</p>
                            <a href="{{ route('frontend.cars.show', $car) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<style scoped>
.card-body{background:#FFF!important}
</style>