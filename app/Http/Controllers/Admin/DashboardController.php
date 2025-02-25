<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function index(){
		return view('admin.index');
	}
    public function info()
    {
        //Overview statistics
        $totalCars = Car::count();
        $availableCars = Car::where('availability', 'available')->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::sum('total_cost');
		
		\Log::info('Total Cars: ' . $totalCars);
		\Log::info('Available Cars: ' . $availableCars);
		\Log::info('Total Rentals: ' . $totalRentals);
		\Log::info('Total Earnings: ' . $totalEarnings);
			
        return view('admin.info', compact('totalCars', 'availableCars', 'totalRentals', 'totalEarnings'));
		
    }
	

    //Cars Management
    public function manageCars()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    public function createCar()
    {
        return view('admin.cars.create');
    }

    public function storeCar(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|in:available,not available',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $car = new Car();
        $car->name = $request->name;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->car_type = $request->car_type;
        $car->daily_rent_price = $request->daily_rent_price;
        $car->availability = $request->availability;
        
        if ($request->hasFile('image')) {
            $car->image = $request->file('image')->store('images', 'public');
        }

        $car->save();

        return redirect()->route('admin.cars.index');
    }

    // Rental Management
    public function manageRentals()
    {
        $rentals = Rental::with('car')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    // Customer Management
    public function manageCustomers()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }
}
