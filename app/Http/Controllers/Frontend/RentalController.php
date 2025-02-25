<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RentalConfirmationMail;  

class RentalController extends Controller
{
	public function index()
    {
		$rental = Rental::where('user_id', auth()->id())->get(); // Example, adjust as needed   
        return view('frontend.rentals.index', compact('rental'));
    }
	
   public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if (!$car->availability) {
            return back()->withErrors('This car is not available.');
        }
		
        $total_cost = $car->daily_rent_price * ((strtotime($validated['end_date']) - strtotime($validated['start_date'])) / (60 * 60 * 24)+1);
        
        Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_cost' => $total_cost
        ]);

        // Send email to user and admin
        // Implement email functionality
        
        return redirect()->route('frontend.rentals.index');
    }
}
