<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function apiIndex()
    {
        $ban = Banner::all();
        return response()->json($ban);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'link' => 'required'
        ]);

        $path = "https://via.placeholder.com/720x480";

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('image');
        }

        $post = new Banner();
        $post->id = $request->user()->id;
        $post->name = $request->input('category_id');
        $post->image = $path;

        $post->save();
        return response()->json($post);
    }


    public function apiPost($id)
    {
        $post = Banner::find($id);
        return response()->json($post);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'link' => 'required'
        ]);

        $post = Banner::find($id);

        $path = $post->path;

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('image');
        }
        $post->id = $request->user()->id;
        $post->name = $request->input('name');
        $post->image = $path;

        $post->save();
        return response()->json($post);
    }

    public function apiDestroy($id)
    {
        $post = Banner::find($id);
        $post->delete();
        return response()->json(['message' => 'Delete Post successfuly']);
    }
}
