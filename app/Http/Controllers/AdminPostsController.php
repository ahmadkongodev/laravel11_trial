<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    public function edit(Post $post)
    {
         
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated= $request->validate([
            'title'=>['required', ],
            'content'=>['required', ]
        ]);
        $post->update($validated);
        return redirect()->route("admin")->with('message','Post Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("admin")->with('message','Post deleted Successfully');

    }
}
