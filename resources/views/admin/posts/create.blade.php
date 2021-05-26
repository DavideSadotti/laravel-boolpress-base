@extends('layouts.base')

@section('pageTitle')
    Crea un nuovo post
@endsection

@section('content')

	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<form action="{{route('admin.posts.store')}}" method="POST">
		@method('POST')
		@csrf
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
		</div>
		<div class="form-group">
			<label for="date">Date</label>
			<input type="date" class="form-control" id="date" name="date" placeholder="Date" value="{{ old('date') }}">
		</div>
		<div class="form-group">
			<label for="content">Contet</label>
			<textarea type="text" class="form-control" id="content" name="content" placeholder="Content" rows="8" value="{{ old('content') }}"></textarea>
		</div>
		<div class="form-group">
			<label for="image">Image</label>
			<input type="text" class="form-control" id="image" name="image" placeholder="Image" value="{{ old('image') }}">
		</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="published" name="published">
            <label class="form-check-label" for="published">Pubblica</label>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </div>
	</form>
@endsection