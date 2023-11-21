<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    function index()
    {
        $userId = Auth::user()->id;

        $postsByMe = Post::orderBy('created_at', 'DESC')
            ->where('user_id', $userId)
            ->get();
        $postsByOther = Post::orderBy('created_at', 'DESC')
            ->where('user_id', '<>', $userId)
            ->get();
        return view('admin.posts.lists', compact('postsByMe', 'postsByOther'));
    }
    function add(){
        return view('admin.posts.add');
    }
    function postAdd(Request $request){
        $request->validate([
            'title' =>'required',
            'content_post' =>'required'
        ]);
        $posts = new Post();
        $posts->title = $request->title;
        $posts->content = $request->content_post;
        $posts->user_id = Auth::user()->id;
        $posts->save();
        return redirect()->route('admin.posts.index')
            ->with('msg', 'Thêm Bài Viết Thành Công!')
            ->with('type', 'success');
    }
    function edit(Post $post){
        $this->authorize('update', $post);
        return view('admin.posts.edit', compact('post'));
    }
    function postEdit(Post $post, Request $request){
        $this->authorize('update', $post);
        $request->validate([
            'title' =>'required',
            'content_post' =>'required',
        ]);
        $post->title = $request->title;
        $post->content = $request->content_post;
        $post->update();
        return back()
            ->with('msg', 'Cập Nhật Bài Viết Thành Công!')
            ->with('type', 'success');
    }
    function delete(Post $post){
        $status = Post::destroy($post->id);
        if ($status){
            return redirect()->route('admin.posts.index')
                ->with('msg', 'Bạn Xóa Bài Viết Thành Công!')
                ->with('type', 'success');
        }
        return redirect()->route('admin.posts.index')
            ->with('msg', 'Xóa Bài Viết Không Thành Công, Hãy Thử Lại')
            ->with('type', 'danger');
    }
}
