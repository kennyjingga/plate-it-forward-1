<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;

class SupportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'additional_info' => 'required|string',
        ]);

        Support::create([
            'name' => $request->name,
            'email' => $request->email,
            'information' => $request->additional_info,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent!');
    }

    public function updateHandled(Request $request, $id)
    {
        $support = Support::findOrFail($id);
        $support->handled = $request->handled ? 1 : 0;
        $support->save();

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $supports = Support::all(); // Ambil semua data dari tabel supports
        return view('support', compact('supports'));
    }
}
