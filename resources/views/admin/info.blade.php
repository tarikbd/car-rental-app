@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Info Page</h1>
        <div class="row">
            <div class="col-xs-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center text-white">Total Cars</h5>
						<hr class="bg-white" />
                        <p class="text-center text-white fw-bold">{{ isset($totalCars) ? $totalCars : 'No data available' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center text-white">Available Cars</h5><hr class="bg-white" />
                        <p class="text-center text-white">{{ isset($availableCars) ? $availableCars : 'No data available' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center text-white">Total Rentals</h5>
						<hr class="bg-white" />
                        <p class="text-center text-white">{{ isset($totalRentals) ? $totalRentals : 'No data available' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center text-white">Total Earnings</h5>
						<hr class="bg-white" />
                        <p class="text-center text-white">${{ isset($totalEarnings) ? $totalEarnings : 'No data available' }}</p>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style scoped>
.card-body{background:#2486ad}p{font-weight:bold!important}
</style>


