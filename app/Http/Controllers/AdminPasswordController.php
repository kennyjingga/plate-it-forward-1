<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('admin.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins,email']);

        $admin = Admin::where('email', $request->email)->first();

        $token = Str::random(60);
        $admin->reset_token = $token;
        $admin->token_expiry = now()->addMinutes(30);
        $admin->save();

        $resetLink = url("/admin/reset-password/{$token}");

        Mail::send('emails.reset_password', ['resetLink' => $resetLink], function ($message) use ($admin) {
            $message->to($admin->email)->subject('Reset Password');
        });

        return redirect('/admin/login');
    }


    public function showResetForm($token)
    {

        // dd($token); // Debug: Harus menampilkan token di browser
        // $restaurant = Restaurant::where('reset_token', $token)->first();
        // dd($restaurant);
        // $restaurant = \App\Models\Restaurant::where('reset_token', $token)->first();
        // dd($restaurant);


        $admin = Admin::where('reset_token', $token)
            ->where('token_expiry', '>', now())
            ->first();

        if (!$admin) {
            return abort(404, 'Token reset password tidak valid atau sudah kadaluarsa.');
        }


        // return view('restaurant.reset-password', compact('token'));
        // return view('restaurant.reset-password', ['token' => $token]);
        return view('admin.reset-password', ['token' => $token]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $admin = Admin::where('reset_token', $request->token)
            ->where('token_expiry', '>', now())
            ->first();

        if (!$admin) {
            return back()->withErrors(['token' => 'Token tidak valid atau telah kedaluwarsa']);
        }

        $admin->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'token_expiry' => null
        ]);

        return redirect('/admin/login')->with('message', 'Password berhasil direset!');
    }
}
