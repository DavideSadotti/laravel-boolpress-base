<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    protected $validation = [
        'date' => 'required|date',
        'content' => 'required|string',
        'image' => 'nullable|url'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts';
        
        // VALIDATION
        $request->validate($this->validation);

        $data = $request->all();
        
        // CONTROLLO CHECKBOX
        $data['published'] = !isset($data['published']) ? 0 : 1;
        // IMPOSTO LO SLUG PARTENDO DAL TITLE
        $data['slug'] = Str::slug($data['title'], '-');

        // INSERT
        $newPost = Post::create($data);    
        
        // AGGIUNGO I TAGS
        $newPost->tags()->attach($data['tags']);

        // REDIRECT
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts,title,' . $post->id;

        // VALIDATION
        $request->validate($validation);

        $data = $request->all();
        
        // CONTROLLO CHECKBOX
        $data['published'] = !isset($data['published']) ? 0 : 1;
        // IMPOSTO LO SLUG PARTENDO DAL TITLE
        $data['slug'] = Str::slug($data['title'], '-');

        // UPDATE
        $post->update($data);

        // AGGIORNO I TAGS
        $post->tags()->sync($data['tags']);

        // RETURN
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Il post è stato eliminato!');
    }
}
