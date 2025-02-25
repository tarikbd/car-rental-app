@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="text-center mb-5">Admin Dashboard</h3>
         <h1 class="text-center mb-5">Welcome {{ Auth::user()->name }} To Car Rent App</h1>
		  <h3 class="text-center mb-5">You have been logged in as Admin Successfully</h3>
        
    </div>
@endsection
<style scoped>
.card-body{background:#2486ad}p{font-weight:bold!important}
</style>


