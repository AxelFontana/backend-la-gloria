<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id')->paginate(9);;
        return view('CategoryViews.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CategoryViews.category-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Category::$rules);

        Category::create($validatedData);

        return redirect()->route('categories.index')
            ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('CategoryViews.category-edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛñÑ0-9\s ]{1,20}$/',
                Rule::unique('brands')->ignore($category->id)
            ],
        ]);

        $rules = Category::$rules;
        unset($rules['name']);

        $validatedData = array_merge($validatedData, $request->validate($rules));

        $category->update($validatedData);

        return redirect()->route('categories.index');
    }

    public function setEnable(Request $request, Category $category)
    {
        $enable = $request->input('switch-state') === 'on';
    
        $category->update(['enable' => $enable]);
    
        $message = $enable ? 'Category enabled successfully' : 'Category disabled successfully';
    
        return redirect()->route('categories.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
