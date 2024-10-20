<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'user_type' => ['required', 'in:user,admin'], // Validate user type
        'admin_secret_key' => ['required_if:user_type,admin'], // Admin secret key validation
    ]);

    // Check if the admin secret key matches the .env value
    if ($request->user_type === 'admin' && $request->admin_secret_key !== env('ADMIN_SECRET_KEY')) {
        return back()->withErrors(['admin_secret_key' => 'Invalid Admin Secret Key']);
    }

    // Create the user with the selected user type
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type' => $request->user_type, // Store the user type
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard'));
}

}
