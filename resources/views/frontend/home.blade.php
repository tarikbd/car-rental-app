@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Car Rental Service</h1>
        <p>Find your perfect car for rent.</p>
        <a href="{{ route('frontend.cars.index') }}" class="btn btn-primary">Browse Cars</a>
    </div>
@endsection