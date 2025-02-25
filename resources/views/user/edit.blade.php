@extends('layouts.admin')

@section('content')
<div class="container">
        <h1>Update Customers</h1>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

     <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <!-- For each customer, show their fields -->
    @foreach ($user->customers as $customer)
        <div>
            <label for="phone_{{ $customer->id }}">Phone</label>
            <input type="text" name="customers[{{ $customer->id }}][phone]" value="{{ old('customers.' . $customer->id . '.phone', $customer->phone) }}">
        </div>

        <div>
            <label for="address_{{ $customer->id }}">Address</label>
            <input type="text" name="customers[{{ $customer->id }}][address]" value="{{ old('customers.' . $customer->id . '.address', $customer->address) }}">
        </div>
    @endforeach

    <button type="submit">Update</button>
	
            <!-- Delete Form -->
            <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this customer?');">    
</form>
        
</form>
</div>
@endsection