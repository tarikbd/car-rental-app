@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Booking Confirmation</h1>
        <p>Your booking for {{ $rental->car->name }} has been confirmed!</p>
        <p>Start Date: {{ $rental->start_date }}</p>
        <p>End Date: {{ $rental->end_date }}</p>
        <p>Total Cost: ${{ $rental->total_cost }}</p>
    </div>
@endsection