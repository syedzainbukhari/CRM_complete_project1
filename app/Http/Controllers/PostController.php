<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function index(){

        $posts = auth()->user()->post()->paginate(5);
//        $posts = Post::all();
        return view('admin.posts.viewIndex',['posts'=>$posts]);
    }
    public function show(Post $post){

        return view('blog-post',['post'=>$post]);

    }
    public function create(){

        return view('admin.posts.create');

    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
            'body' => 'required'
        ]);

        // Check if a file has been uploaded and store it
        if ($request->hasFile('post_image')) {
            $imagePath = $request->file('post_image')->store('images');
            $validatedData['post_image'] = $imagePath;
        }

        // Create the post associated with the authenticated user
        auth()->user()->post()->create($validatedData);

        // Redirect back to the previous page with a success message
        return redirect()->route('posts.viewIndex')->with('success', 'Post created successfully');
    }
    public function destroy(Post $post){
        $post->delete();


        session::flash('message','Post was deleted');
        return back();
    }

    public function edit(Post $post){
       $this->authorize('view',$post);

        return view('admin.posts.edit',['post'=>$post]);
    }
    public function update(Request $request, Post $post)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        // Check if a new post image is provided
        if ($request->hasFile('post_image')) {
            // Store the new post image and update the post's image attribute
            $validatedData['post_image'] = $request->file('post_image')->store('images');
            $post->post_image = $validatedData['post_image'];
        }

        // Update post attributes
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];

        // Save the updated post for the authenticated user
        auth()->user()->post()->save($post);
//$this->authorize('update',$post);
//        $post->save();

        // Redirect back to the posts index page
        return redirect()->route('posts.viewIndex')
            ->with('post-updated-message', 'Post with title "' . $validatedData['title'] . '" updated.');
    }

//    public function update(Request $request , Post $post)
//    {
//
//        $inputs = request()->validate([
//            'title' => 'required|min:3|max:255',
//            'post_image' => 'file',
//            'body' => 'required'
//        ]);
//
//
//        if (request('post_image')) {
//            $inputs['post_image'] = request('post_image')->store('images');
//            $post->post_image = $inputs['post_image'];
//        }
//
//        $post->title = $inputs['title'];
//        $post->body = $inputs['body'];
//
//        auth()->user()->post()->save($post);
////        $this->authorize('update', $post);
////
////
////        $post->save();
////
////        session()->flash('post-updated-message', 'Post with title was updated ' . $inputs['title']);
//
//        return redirect()->route('posts.viewIndex');
//    }

//    public function store(Request $request){
//        $inputs = request()->validate([
//            'title'=> 'required|min:8|max:255',
//            'post_image'=> 'file',
//            'body'=> 'required'
//        ]);
//        if(request('post_image')){
//           $inputs['post_image']=request('post_image')->store('images');
//        }
//
//
//        auth()->user()->posts()->create($inputs);
//        return back();
//
//    }
//    public function store(){
//        auth()->user();
//        dd(request()->all());
//    }
}
