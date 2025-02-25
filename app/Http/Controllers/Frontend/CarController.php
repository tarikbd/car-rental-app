<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
   public function index(Request $request)
    {
        $query = Car::query();
        
        if ($request->has('car_type')) {
            $query->where('car_type', $request->car_type);
        }

        $cars = $query->get();
        return view('frontend.cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('frontend.cars.show', compact('car'));
    }
}
