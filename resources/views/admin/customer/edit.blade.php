@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Customer</h1>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
       <form action="" method="POST">
    @csrf
    @method('PUT') <!-- This makes it a PUT request -->
            
            <div class="form-group">
               <label for="name">Name</label>
				<input type="text" name="name" value="{{ old('name', $user->name) }}" required>
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" value="{{ old('email', $user->email) }}" required>
			</div>
			
			<!-- For each customer, show their fields -->
			@foreach ($user->customers as $customer)
				<div class="form-group">
					<label for="phone_{{ $customer->id }}">Phone</label>
					<input type="text" name="customers[{{ $customer->id }}][phone]" value="{{ old('customers.' . $customer->id . '.phone', $customer->phone) }}">
				</div>

				<div class="form-group">
					<label for="address_{{ $customer->id }}">Address</label>
					<input type="text" name="customers[{{ $customer->id }}][address]" value="{{ old('customers.' . $customer->id . '.address', $customer->address) }}">
				</div>
			@endforeach
            
            <div class="form-group">               
				<a href="" class="btn btn-warning">Edit</a>
				<form action="" method="POST" class="d-inline-block">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>                        
            </div>            
        </form>
    </div>
@endsection
