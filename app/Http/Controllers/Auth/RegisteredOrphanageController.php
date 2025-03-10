<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Orphanage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredOrphanageController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('orphanage.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'contact' => ['required', 'string', 'max:255'],
        'donation' => ['required', 'numeric', 'min:0'],
    ]);

    $orphanage = Orphanage::create([
        'name' => $request->name,
        'address' => $request->address,
        'city' => $request->city,
        'contact' => $request->contact,
        'donation' => (double) $request->donation,
    ]);

    event(new Registered($orphanage));

    // Auth::guard('orphanage')->login($orphanage);

    return redirect(route('panti', absolute: false));
}

}
