<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function create()
    {
       
        return view('Category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
                'name' => $request->input('name'),
            ]);
        // Post::create($request->all());

        return redirect()->route('posts.create')->with('success', 'Category created successfully');
    }

    public function edit(Request $request)
    {
        $categorie = Category::findOrFail($request->id);
        return view('Category.edit',compact('categorie'));
    }

    public function update(Request $request)
    {
       
        $category = Category::findOrFail($request->category_id);
       
        $request->validate([
            'name' => 'required',
        ]);
       
        $category->title = $request->input('name');            
        $category->save();
        return redirect()->route('posts.create')->with('success', 'Category updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
       
        $category = Category::findOrFail($request->id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
