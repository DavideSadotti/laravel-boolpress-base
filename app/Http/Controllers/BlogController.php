<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){

        return view('guest.index');

    }

    public function show($slug){

        // PRENDO I DATI DAL DB
        $post = Post::where('slug', $slug)->first();

        if($post == null){
            abort(404);
        }

        // RESTITUISCO LA PAGINA DEL POST
        return view('guest.show', compact('post'));
    }

}
