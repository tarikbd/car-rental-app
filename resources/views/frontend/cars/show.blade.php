@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>{{ $car->name }} ({{ $car->brand }})</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid" alt="{{ $car->name }}">
            </div>
            <div class="col-md-6">
                <p>Model: {{ $car->model }}</p>
                <p>Year: {{ $car->year }}</p>
                <p>Type: {{ $car->car_type }}</p>
                <p>Price: ${{ $car->daily_rent_price }} per day</p>

                @if($car->availability)
                    <form action="{{ route('frontend.rentals.store', $car) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Book Car</button>
                    </form>
                @else
                    <p class="text-danger">This car is currently unavailable.</p>
                @endif
            </div>
        </div>
    </div>
@endsection