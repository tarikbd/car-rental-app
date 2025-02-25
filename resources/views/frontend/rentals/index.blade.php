@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>Your Bookings</h1>
        @if($rental->isEmpty())
            <p>You have not made any bookings yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Cost</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($rental as $rent)
                        <tr>
                            <td>{{ $rent->car->name }}</td>
                            <td>{{ $rent->start_date }}</td>
                            <td>{{ $rent->end_date }}</td>
                            <td>${{ $rent->total_cost }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection