<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
			 'daily_rent_price' => 'required',			
            //'daily_rent_price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',  // 4 digits total, with 2 decimal places
           'availability' => 'required|in:available,not available',
            'image' => 'nullable|image | mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        //Car::create($validated);
         // Create new car
		$car = new Car();
		$car->name = $request->name;
		$car->brand = $request->brand;
		$car->model = $request->model;
		$car->year = $request->year;
		$car->car_type = $request->car_type;
		$car->daily_rent_price = $request->daily_rent_price;
		$car->availability = $request->availability;
		
		// If an image is uploaded, store it
		if ($request->hasFile('image')) {
			$car->image = $request->file('image')->store('car_images', 'public');
		}

		$car->save();

		// Redirect back to the cars index page
		return redirect()->route('admin.cars.index');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required',
            'availability' => 'required|in:available,not available',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        //$car = new Car();
		$car->name = $request->name;
		$car->brand = $request->brand;
		$car->model = $request->model;
		$car->year = $request->year;
		$car->car_type = $request->car_type;
		$car->daily_rent_price = $request->daily_rent_price;
		$car->availability = $request->availability;

		// If an image is uploaded, delete the old one (if it exists) and store the new image
		if ($request->hasFile('image')) {
			// Delete old image if it exists
			if ($car->image) {
				$oldImagePath = public_path('storage/' . $car->image);
				if (file_exists($oldImagePath)) {
					unlink($oldImagePath); // Delete the old image from storage
				}
			}

        // Store the new image
        $car->image = $request->file('image')->store('car_images', 'public');
    }

    $car->save();

    return redirect()->route('admin.cars.index');
	}
	
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index');
    }
}
