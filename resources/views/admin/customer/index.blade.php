@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Customers</h1>
        <table class="table mt-4">
            <thead>
                <tr>                    
                    <th>Name</th>
                    <th>Email</th>
					<th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>			
                @foreach($users as $user)
                    <tr>    
						<td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if($user->customers && $user->customers->isNotEmpty()) <!-- Check if customers exists and is not empty -->
                    @foreach ($user->customers as $customer)
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                    @endforeach
                @else
                    <td colspan="2">No customers available</td>
                @endif
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="">
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
