<?php

// app/Http/Controllers/OrphanageController.php
namespace App\Http\Controllers;

use App\Models\Orphanage;
use Illuminate\Http\Request;

class OrphanageController extends Controller
{
    public function index()
    {
        $orphanages = Orphanage::all();
        return view('panti', compact('orphanages'));
    }

    public function create()
    {
        return view('createOrphanage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact' => 'required',
            'donation' => 'required|numeric',
        ]);

        Orphanage::create($request->all());

        return redirect()->route('panti.index')->with('success', 'Orphanage added successfully.');
    }

    public function edit($id)
    {
        $orphanage = Orphanage::findOrFail($id);
        return view('updateOrphanage', compact('orphanage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact' => 'required',
            'donation' => 'required|numeric',
        ]);

        $orphanage = Orphanage::findOrFail($id);
        $orphanage->update($request->all());

        return redirect()->route('panti.index')->with('success', 'Orphanage updated successfully.');
    }

    public function destroy($id)
    {
        $orphanage = Orphanage::findOrFail($id);
        $orphanage->delete();
        
        return redirect()->route('panti.index')->with('success', 'Orphanage deleted successfully.');
    }
}
