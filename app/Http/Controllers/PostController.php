<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use File;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{
    public function create()
    {
        $categories = Category::get();
        return view('Posts.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');
        // $this->uploadImage($request);
            Post::create([
                'title' => $request->input('title'),
                'image' => $imagePath,
                'content' => $request->input('content'),
                'start_date'  => $request->input('start_date'),
                'end_date'  => $request->input('end_date'),
                'guest_numbers'  => $request->input('nubmer_of_guests'),
                'category_id'  => $request->input('category_id'),
            ]);
        // Post::create($request->all());

        return redirect()->route('home')->with('success', 'Post created successfully');
    }

    public function edit(Request $request)
    {
        $categories = Category::get();
        $post = Post::findOrFail($request->id);
        return view('Posts.edit',compact('categories','post'));
    }

    public function update(Request $request)
    {
       
        $post = Post::findOrFail($request->post_id);
       
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads', 'public');
                $post->image = $imagePath;
            }
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->start_date  = $request->input('start_date');
            $post->end_date  = $request->input('end_date');
            $post->guest_numbers  = $request->input('nubmer_of_guests');
            $post->category_id  = $request->input('category_id');
            
            $post->save();
            return redirect()->route('home')->with('success', 'Post updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
       
        $post = Post::findOrFail($request->id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    // protected function uploadImage(Request $request, $post=null)
    // {
    //     $path   = 'post/';

    //     // for image
    //     if($request->hasfile('image')) 
    //     { 
    //         $request->validate([
    //             'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
    //         ]); 
        
    //         $file = $request->file('image');
    
    //         $extension       = $file->getClientOriginalExtension(); // getting image extension
    //         $post          = time().rand(1,988).'.'.'webp';

    //         $image_resize    = Image::make($file)->encode('webp', 90)->resize(512, 512, function ($constraint) {
    //             $constraint->aspectRatio();
    //         });
            
    //         // if directory not exist then create directiory
    //         if (! File::exists(storage_path('/app/public/').$path)) {
    //             File::makeDirectory(storage_path('/app/public/').$path, 0775, true);
    //         }
            
    //         $image_resize->save(storage_path('/app/public/'.$path.$post));
            
    //         $user->avatar    = $path.$post;
            
    //     }
        
    //     // if(empty($user->avatar) || $user->avatar == 'users/default.png')
    //     // {
    //     //     $request->validate([
    //     //         'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
    //     //     ]); 
    //     // }
    // }

}
