<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id')->paginate(9);;
        return view('ProductViews.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('enable', true)->get();
        $brands = Brand::where('enable', true)->get();
        return view('ProductViews.product-create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Product::$rules);
        Product::create($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');

    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('enable', true)->get();
        $brands = Brand::where('enable', true)->get();
        return view('ProductViews.product-edit',compact('product','categories','brands'));
    }



    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛñÑ0-9\s ]{1,30}$/',
                Rule::unique('products')->ignore($product->id)
            ],
        ]);

        $rules = Product::$rules;
        unset($rules['name']);

        $validatedData = array_merge($validatedData, $request->validate($rules));

        $product->update($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }



    public function setEnable(Request $request, Product $product)
    {
        $enable = $request->input('switch-state') === 'on';
    
        $product->update(['enable' => $enable]);
    
        $message = $enable ? 'Product enabled successfully' : 'Product disabled successfully';
    
        return redirect()->route('products.index')->with('success', $message);
    }

    public function editStock(Request $request, Product $product){

            $newStock = $product->stock + $request->stock;

            if ($newStock < 0) {
                $newStock = 0;
            } elseif ($newStock > 9999) {
                return redirect()->back()->withErrors([$product->id => 'Stock cannot exceed 9999']);

                //return redirect()->back()->withErrors(['stock' => 'Stock cannot exceed 9999']);
            }
            $product->update(['stock' => $newStock]);
            return redirect()->route('products.index')
                ->with('success', 'Stock changed successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
