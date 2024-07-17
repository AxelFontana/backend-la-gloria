<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id')->paginate(9);
        return view('BrandViews.brands', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('BrandViews.brand-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate (Brand::$rules);
        Brand::create($validateData);

        return redirect()->route('brands.index')
            ->with('succes', 'Brand created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('BrandViews.brand-edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛñÑ0-9\s ]{1,20}$/',
                Rule::unique('brands')->ignore($brand->id)
            ],
        ]);
        $rules = Brand::$rules;
        unset($rules['name']);

        $validatedData = array_merge($validatedData, $request->validate($rules));

        $brand->update($validatedData);

        return redirect()->route('brands.index');
    }

    public function setEnable(Request $request, Brand $brand)
    {
        $enable = $request->input('switch-state') === 'on';
    
        $brand->update(['enable' => $enable]);
    
        $message = $enable ? 'Brand enabled successfully' : 'Brand disabled successfully';
    
        return redirect()->route('brands.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
