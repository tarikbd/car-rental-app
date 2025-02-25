@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Cars</h1>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Add New Car</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
					<th>Model</th>
					<th>Year</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
						<td><img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" width="100"></td>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->brand }}</td>
						<td>{{ $car->model }}</td>
						<td>{{ $car->year }}</td>
                        <td>{{ $car->car_type }}</td>
                        <td>${{ $car->daily_rent_price }}</td>
                        <td>{{ $car->availability ? 'Available' : 'Not Available' }}</td>
                        <td>
                            <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
<style scoped>
.card{height:160px!important;min-width:170px!important}.card-body{background:teal}
</style>