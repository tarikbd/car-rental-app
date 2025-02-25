<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\RentalConfirmationMail;

class CustomerController extends Controller
{
   public function index(Request $request)
    {
		//$customers = Customer::all(); 
		$users = User::with('customers')->get();
			
		//$customers = DB::table('users')->join('customers','users.id','=','customers.user_id')->select('users.name','users.email','customers.phone','customers.address')->get();	
        return view('admin.customer.index', compact('users'));	
		
    }
	
	// public function edit(Customer $customer)
    // {
        // return view('admin.customer.edit', compact('customer'));
    // }
	
	public function edit(User $user)
	{
		// Get the user and their associated customers
		$user->load('customers');  // This will eagerly load the customers relationship

		return view('admin.customer.edit', compact('user'));
	}

    // public function update(Request $request, Customer $customer)
    // {
        // $validated = $request->validate([            
            // 'phone' => 'numeric',
            // 'address' => 'string',            
        // ]);		
		
		// $customer = new customer();
		// $customer->update($validated);        
		
		// $customer->phone = $request->phone;
		// $customer->address = $request->address;	
	
		// $customer->update();
		// if (!$customer) {
			// return redirect()->route('admin.customers.index')->with('error', 'Customer not found');
		// }
		
		// Use mass assignment or individual assignments
		// $customer->update();  

		// return redirect()->route('admin.customers.index');
	// }
	
	public function update(Request $request, User $user)
	{
		// Validate user input
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255',
			'customers.*.phone' => 'nullable|string|max:15',  // You can customize this validation
			'customers.*.address' => 'nullable|string|max:255',
		]);

		// Update user
		$user->update([
			'name' => $request->name,
			'email' => $request->email,
		]);

		// Update each customer
		foreach ($request->customers as $customerId => $customerData) {
			$customer = Customer::find($customerId);  // Find each customer by ID
			if ($customer) {
				$customer->update([
					'phone' => $customerData['phone'],
					'address' => $customerData['address'],
				]);
			}
		}

		// Redirect back with a success message
		return redirect()->route('admin.customers.index')->with('success', 'User and customers updated successfully!');
	}
	
	public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index');
    }
	
	
}
