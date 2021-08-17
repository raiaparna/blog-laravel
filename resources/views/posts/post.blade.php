@extends('layouts.app')
@section('content')
<div class="container 2xl:w-4/5 mx-auto py-5 sm:py-10 px-6 bg-white shadow sm:shadow-md post-single relative">
  @if(Auth::check() && Auth::user()->is_admin == 1)
    <div class="absolute right-1 top-3">
      @if($post->showcase_flag == 1)
        <span class="btn btn-edit">Showcase Post</span>
      @else
        <a href="/update-showcase/{{ $post->id }}" class="btn btn-save">Set Post as Showcase</a>
      @endif
    </div>
  @endif

  <h1>{{ $post->title }}</h1>
  <h3 class="post-short">
    {{ $post->short_description }}
  </h3>
  <div class="text-center">
    <p class="post-info mb-5">
      by <a href="/profile/{{ $post->user->username}}" class="link">{{ $post->user->name }}</a>
      <span>/</span>
      {{ date('jS M Y',strtotime($post->updated_at)) }}
      <span>/</span>
      {{ $read_duration }} min read
    </p>
  </div>
  <img src="{{ asset('images/'.$post->image_url) }}" class="mb-3 mx-auto object-center max-h-screen">
  <p class="img-caption">{{ $post->image_caption }}</p>
  <div class="post-long my-10">
    {!! htmlspecialchars_decode($post->long_description) !!}
  </div>
  <p class="text-center">
    <a href="mailto: feedback.blog@gmail.com" class="hover:text-yellow-400">feedback.blog@gmail.com</a>
  </p>
</div>
@endsection