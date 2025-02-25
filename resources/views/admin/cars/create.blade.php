@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Car</h1>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Car Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand" class="form-control" required>
            </div>
			<div class="form-group">
                <label for="brand">Model</label>
                <input type="text" id="model" name="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="car_type">Car Type</label>
                <select id="car_type" name="car_type" class="form-control" required>
                    <option value="SUV">SUV</option>
                    <option value="Sedan">Sedan</option>
                    <option value="Truck">Truck</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Year of Manufacture</label>
                <input type="number" id="year" name="year" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="daily_rent_price">Daily Rent Price</label>
                <input type="number" id="daily_rent_price" name="daily_rent_price" class="form-control" required>
            </div>
            <!--<div class="form-group">
                <label for="availability">Availability</label>
                <select id="availability" name="availability" class="form-control" required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div> -->
			<div>
			<label for="availability">Availability:</label>
				<select id="availability" name="availability" required>
					<option value="available">Available</option>
					<option value="not available">Not Available</option>
				</select>
			</div>
            <div class="form-group">
                <label for="image">Car Image</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Car</button>
        </form>
    </div>
@endsection
