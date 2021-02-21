<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function apiIndex()
    {
        $posts = Post::with('user', 'category')->all();
        return response()->json($posts);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required|min:10'
        ]);

        $path = "https://via.placeholder.com/720x480";

        if ($request->hasFile('thumbnail')) {
            $path =  $request->file('thumbnail')->store('thumbnail');
        }

        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->category_id = $request->input('category_id');
        $post->thumbnail = $path;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return response()->json($post);
    }


    public function apiPost($id)
    {
        $post = Post::with('user', 'category')->find($id);
        return response()->json($post);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required|min:10'
        ]);

        $post = Post::with('user', 'category')->find($id);

        $path = $post->path;

        if ($request->hasFile('thumbnail')) {
            $path =  $request->file('thumbnail')->store('thumbnail');
        }
        $post->user_id = $request->user()->id;
        $post->category_id = $request->input('category_id');
        $post->thumbnail = $path;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return response()->json($post);
    }

    public function apiDestroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['message' => 'Delete Post successfuly']);
    }
}
