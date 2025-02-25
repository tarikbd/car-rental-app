<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle the incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the user input
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',  // Default user role as 'customer'
        ]);

        // Dispatch the registered event (for any listeners, such as email verification)
        event(new Registered($user));

        // Log the user in after registration
        Auth::login($user);

        // Redirect to the home page or dashboard
        return redirect()->route('frontend.cars.index')->with('success', 'You have registered successfully!');
    }
	
	public function edit(User $user)
	{
		// Get the user and their associated customers
		$user->load('customers');  // This will eagerly load the customers relationship

		return view('user.edit', compact('user'));
	}
	
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
	
	 public function destroy(User $user)
    {
        // Delete associated customers
        $user->customers()->delete();  // This deletes all customers related to the user

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('admin.users.index')->with('success', 'User and associated customers deleted successfully!');
    }
}

