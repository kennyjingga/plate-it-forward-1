<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productexp;
use App\Models\Products;



class ProductsexpsController extends Controller
{
    public function show($id)
    {
        $product = Products::findOrFail($id);
        $productExps = ProductExp::where('product_id', $id)->get();
    
        // Hitung total quantity
        $totalQuantity = $productExps->sum('quantity');
    
        return view('productexp', compact('product', 'productExps', 'totalQuantity'));
    }







  public function create($product_id)
{
    $productsearch = Products::findOrFail($product_id);
    
    return view('addproductexp',compact('productsearch'));
}


public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'price_discount' => 'required|integer|min:0',
        'expired_at' => 'required|date',
    ]);

    // Simpan data ke database
    ProductExp::create([
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'price_discount' => $request->price_discount,
        'expired_at' => $request->expired_at,
        'created_at' => now(), // Timestamp otomatis
    ]);

    // Redirect ke halaman productexp/{product_id}
    return redirect()->route('productexp.show', $request->product_id)
                     ->with('success', 'Data berhasil ditambahkan!');
}

public function destroy(Request $request)
{
    if ($request->has('delete_ids')) {
        ProductExp::whereIn('id', $request->delete_ids)->delete();

        return redirect()->back()->with('success', 'Produk expired berhasil dihapus.');
    }

    return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
}



public function edit($id)
{
    $exp = ProductExp::findOrFail($id);
    return view('updaterestorantproductexp', compact('exp'));
}

public function update(Request $request, $id)
{
    $exp = ProductExp::findOrFail($id);
    $exp->update($request->all());
    return redirect()->route('productexp.show', $exp->product_id)->with('success', 'Data berhasil diperbarui!');

}



public function deleteMultiple(Request $request)
{
    $deleteIds = $request->input('delete_ids');

    if (!$deleteIds || count($deleteIds) === 0) {
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
    }

    ProductExp::whereIn('id', $deleteIds)->delete();

    return redirect()->back()->with('success', 'Data yang dipilih berhasil dihapus.');
}





 
}
