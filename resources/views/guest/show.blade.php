@extends('layouts.guest')

@section('pageTitle')
    {{ $post->title }}
@endsection

@section('content')
<div class="mt-3">
    <h1>{{ $post->title }}</h1>
    <h4>{{ $post->date }}</h4>
    <p>{{ $post->content }}</p>

    <div class="mt-5">
        <h3>Commenti</h3>
        <ul>
            <li>Ciao</li>
        </ul>
    </div>
</div>
@endsection