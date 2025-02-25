@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Rental</h1>

        <form action="{{ route('admin.rentals.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Customer</label>
                <select name="user_id" id="user_id" class="form-control" required>
					<option value="">Select Customer</option>
					@foreach($customers as $customer)
						<option value="{{ $customer->id }}">{{ $customer->name }}</option>
					@endforeach
				</select>
            </div>

            <div class="form-group">
                <label for="car_id">Car</label>
                <select name="car_id" id="car_id" class="form-control" required>
                    <option value="">Select Car</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->name }} ({{ $car->brand }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_cost">Total Cost</label>
                <input type="number" name="total_cost" id="total_cost" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Rental</button>
        </form>
    </div>
@endsection