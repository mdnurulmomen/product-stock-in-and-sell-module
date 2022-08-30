<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('sales')->latest()->paginate(5);
    
        return view('sales.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSaleCreateForm(Product $product)
    {
        return view('sales.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productToSell = Product::findOrFail($request->product_id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1|max:'.$productToSell->available_quantity,
            'payment' => 'required|string|in:cash,credit,mfs',
        ]);
    
        Sale::create([
            'price' => $productToSell->selling_price,
            'quantity' => $request->quantity,
            'payment' => $request->payment,
            'product_id' => $productToSell->id,
        ]);

        $productToSell->decrement('available_quantity', $request->quantity);
     
        return redirect()->route('sales.index')
                        ->with('success','Sale made successfully.');
    }
}
