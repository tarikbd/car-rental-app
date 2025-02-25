@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Rentals</h1>		
		 @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <a href="{{ route('admin.rentals.create') }}" class="btn btn-success">Add Rental</a>

        @if($rentals->isEmpty())
            <p>No rentals found.</p>
        @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Customer</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td>{{ $rental->car->name }}</td>
                        <td>{{ $rental->user->name }}</td>
                        <td>{{ $rental->start_date->format('Y-m-d') }}</td>
                        <td>{{ $rental->end_date->format('Y-m-d') }}</td>
                        <td>${{ $rental->total_cost }}</td>
                        <td>{{ ucfirst($rental->status) }}</td>
                        <td>
                            <a href="{{ route('admin.rentals.edit', $rental) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.rentals.destroy', $rental) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		@endif
    </div>
@endsection
