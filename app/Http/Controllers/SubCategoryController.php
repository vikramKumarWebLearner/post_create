<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class SubCategoryController extends Controller
{
    public function create()
    {
       $categories  = Category::get();
        return view('SubCategory.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

         Subcategory::create([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id')
            ]);
        // Post::create($request->all());

        return redirect()->route('posts.create')->with('success', 'Category created successfully');
    }

    public function edit(Request $request)
    {
        $subcategorie =  Subcategory::findOrFail($request->id);
        $categories = Category::get();
        return view('Category.edit',compact('subcategorie','categories'));
    }

    public function update(Request $request)
    {
       
        $subcategory =  Subcategory::findOrFail($request->subcategorie_id);
       
        $request->validate([
            'name' => 'required',
        ]);
       
        $subcategory->title = $request->input('name');
        $subcategory->category_id = $request->input('category_id');            
        $subcategory->save();
        return redirect()->route('posts.create')->with('success', 'SubCategory updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
       
        $subcategory =  Subcategory::findOrFail($request->id);
        $subcategory->delete();

        return redirect()->back()->with('success', 'SubCategory deleted successfully');
    }
}
