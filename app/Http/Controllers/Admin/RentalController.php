<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\User;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Support\Facades\Mail;
use App\Mail\RentalConfirmationMail;


class RentalController extends Controller
{
	public function email()
    {
        // Fetch all rentals, you can also use pagination if you have many records
        $rentals = Rental::with('car', 'customer')->get(); // Fetch rentals along with car and customer info
        
        // Pass the rentals data to the view
        return $this->view('emails.rental_confirmation', compact('rentals'));
    }
	
	public function index()
    {
        $rentals = Rental::with('car', 'customer')->get(); // Eager load car and customer relations
        return view('admin.rentals.index', compact('rentals'));
    }
	
	
	public function view()
    {
		 $rental = Rental::find(1); // Example: fetching rental with ID 1

        // Pass the $rental variable to the view
        return view('admin.rentals.view', compact('rental'));         
    }
    
	// Show the form to create a new rental
    public function create()
    {
        $cars = Car::all();  // Fetch all cars
        $customers = Customer::all();  // Fetch all customers
        return view('admin.rentals.create', compact('cars', 'customers'));
    }
	
    public function store(Request $request)
    {
        // Validation (optional)
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_cost' => 'required|numeric',
        ]);

        // Create the rental record
        $rental = Rental::create([
            'customer_id' => $validated['customer_id'],
            'car_id' => $validated['car_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_cost' => $validated['total_cost'],
        ]);

        // Fetch the user who made the booking
        $customer = Customer::find($validated['customer_id']); // Define $user here
		
		//$rental = Rental::find($rentalId);
        // Send email to the customer
        Mail::to($customer->email)->send(new RentalConfirmationMail($rental));
		\Log::debug('Rental Data:', [$rental]);
        // Redirect or return response after storing
        return redirect()->route('admin.rentals.index')->with('success', 'Rental created and email sent.');
    }
	
	// Show the form to edit a rental
    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        $cars = Car::all();
        $customer = Customer::all();
        return view('admin.rentals.edit', compact('rental', 'cars', 'customers'));
    }

    // Update the specified rental
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'required|in:ongoing,completed,canceled',
        ]);

        $rental = Rental::findOrFail($id);
        $rental->update($request->all());

        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully!');
    }

    // Delete a rental
    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->delete();

        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully!');
    }
}