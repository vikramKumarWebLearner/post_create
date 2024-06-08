<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subcategory;
class HomeController extends Controller
{
    public function show()
    {
         $categories = Category::get();
         $subCategories = Subcategory::get();
        return view('home',compact('categories','subCategories'));
    }

    public function load_data(Request $request)
    {
         $query = Post::query();
         $query->with('category');
        if($request->category !== null  && $request->category != "null"){
            $query->whereHas('category',function ($query) use($request) {
                $query->where('id',$request->category);
            });
        }

        // dd($request->all());
        // if($request->start_date){
        //     $query->whereDate('start_date',$request->start_date);
        // }

        // if($request->end_date){
        //     $query->whereDate('end_date',$request->end_date);
        // }
            // dd($request->start_date ,$request->end_date);
        if($request->start_date != null &&$request->end_date != null ){
         $query->where('start_date','<=',$request->start_date)
            ->where('end_date','>=',$request->end_date) ;   
        }

            // dd($query->get());
        if($request->subcategory != null  && $request->subcategory != "null" ){
            $query->whereHas('category.subcategory',function ($query) use($request) {
                $query->where('id', $request->subcategory);
            });
        }
            // dd($request->guest_number);
         if($request->guest_number != null){
            $query->where('guest_numbers', $request->guest_number);
        }
        $posts = $query->get();      
        return response()->json(['posts' => $posts]);

    }
}
