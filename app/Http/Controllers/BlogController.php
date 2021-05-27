<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){

        // PRENDO I DATI DAL DB
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->get();
        $tags = Tag::all();

        // RESTITUISCO LA PAGINA HOME
        return view('guest.index', compact('posts', 'tags'));

    }

    public function show($slug){

        // PRENDO I DATI DAL DB
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();

        if($post == null){
            abort(404);
        }

        // RESTITUISCO LA PAGINA DEL POST
        return view('guest.show', compact('post', 'tags'));

    }

    public function filterTag($slug){

        $tags = Tag::all();
        $tag = Tag::where('slug', $slug)->first();
        if($tag == null){
            abort(404);
        }
        $posts = $tag->posts()->where('published', 1)->get();

        return view('guest.index', compact('posts', 'tags'));
    }

    public function addComment(Request $request){

        dd($request->all());
        // $request->validate([
        //     'name' => 'nullable|string|max:100',
        //     'content' => 'required|string'
        // ]);

        // $newComment = new Comment();
        // $newComment->name = $request->name;
        // $newComment->content = $request->content;
        // $newComment->post_id = $post->id;
        // $newComment->save();

        // return back();
    }

}
