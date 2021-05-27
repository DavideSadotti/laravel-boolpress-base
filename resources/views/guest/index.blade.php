@extends('layouts.guest')

@section('pageTitle')
	Boolpress
@endsection


@section('content')
    

    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
        <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
      </div>
    </div>
  </div>

  <main role="main" class="container">
    <div class="row">
      <div class="col-md-8 blog-main">
        
        @foreach ($posts as $post)
          <div class="blog-post">
            <h2 class="blog-post-title">{{$post->title}}</h2>
            <p class="blog-post-meta">{{$post->date}}</p>
            <p>
              {{$post->content}}
            </p>
            <div>
              <a href="{{route('guest.posts.show', ['slug' => $post->slug])}}">Leggi di più</a>
            </div>
          </div><!-- /.blog-post -->
        @endforeach

      </div><!-- /.blog-main -->

@endsection