<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class RestaurantPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('restaurant.forgot-password');
    }

    // public function sendResetLink(Request $request)
    // {
    //     $request->validate(['email' => 'required|email|exists:restaurants,email']);

    //     $restaurant = Restaurant::where('email', $request->email)->first();

    //     $token = Str::random(60);

    //     $restaurant->reset_token = $token;
    //     $restaurant->token_expiry = now()->addMinutes(30);
    //     $restaurant->save();

    //     $resetLink = url("/restaurant/reset-password/{$token}");
    //     Mail::raw("Klik link ini untuk reset password: $resetLink", function ($message) use ($restaurant) {
    //         $message->to($restaurant->email)->subject('Reset Password');
    //     });

    //     return back()->with('message', 'Link reset password telah dikirim ke email Anda.');
    // }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:restaurants,email']);

        $restaurant = Restaurant::where('email', $request->email)->first();

        $token = Str::random(60);
        $restaurant->reset_token = $token;
        $restaurant->token_expiry = now()->addMinutes(60); // Expired dalam 60 menit
        $restaurant->save();

        $resetLink = url("/restaurant/reset-password/{$token}");

        Mail::send('emails.reset_password', ['resetLink' => $resetLink], function ($message) use ($restaurant) {
            $message->to($restaurant->email)->subject('Reset Password');
        });

        return redirect('/restaurant/login');
    }


    public function showResetForm($token)
    {

        // dd($token); // Debug: Harus menampilkan token di browser
        // $restaurant = Restaurant::where('reset_token', $token)->first();
        // dd($restaurant);
        // $restaurant = \App\Models\Restaurant::where('reset_token', $token)->first();
        // dd($restaurant);


        $restaurant = Restaurant::where('reset_token', $token)
            ->where('token_expiry', '>', now())
            ->first();

        if (!$restaurant) {
            return abort(404, 'Token reset password tidak valid atau sudah kadaluarsa.');
        }


        // return view('restaurant.reset-password', compact('token'));
        // return view('restaurant.reset-password', ['token' => $token]);
        return view('restaurant.reset-password', ['token' => $token]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $restaurant = Restaurant::where('reset_token', $request->token)
            ->where('token_expiry', '>', now())
            ->first();

        if (!$restaurant) {
            return back()->withErrors(['token' => 'Token tidak valid atau telah kedaluwarsa']);
        }

        $restaurant->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'token_expiry' => null
        ]);

        return redirect('/restaurant/login')->with('message', 'Password berhasil direset!');
    }
}
