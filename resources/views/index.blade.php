@extends('layouts.app')

@section('content')
  <div class="container 2xl:w-4/5 mx-auto py-5 md:py-10 px-6 bg-white shadow md:shadow-md">
  {{-- Showcase --}}
    @isset($showcase)
    <div class="text-center relative showcase" style="background-image: url({{ asset('images/' . $showcase->image_url) }})">
      <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-50 p-5">
        <h1 class="text-white max-w-lg">{{ $showcase->title }}</h1>
        <p class="hidden sm:block text-white max-w-lg mb-10">{{ $showcase->short_description }}</p>
        <a href="/posts/{{ $showcase->slug }}" class="showcase-read-more">Read More</a>
      </div>
    </div>
    @endisset
    <hr class="dotted" />
    {{-- Post Grid --}}
    <div class="my-10 md:grid grid-cols-3 gap-5 divide-y divide-gray-300 md:divide-y-0">
      @foreach($posts as $post)
      @if($loop->iteration==1)
      <div class="col-span-2 relative">
        <a href="/posts/{{ $post->slug }}">
          <div class="wide-img" style="background-image: url({{ asset('images/' . $post->image_url) }})"></div>
        </a>
        <div class="hidden md:block">
          <span class="absolute top-5 left-5 text-white text-base bg-black bg-opacity-75 p-3 rounded">{{ date('jS M Y',strtotime($post->updated_at)) }}</span>
          <h4 class="absolute bottom-0 left-0 right-0 py-5 mb-0 text-center text-white bg-black bg-opacity-75 p-3">
            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
          </h4>
        </div>
        <div class="my-5 text-center md:hidden">
          <span class="block text-center mb-2 text-gray-500">{{ date('jS M Y',strtotime($post->updated_at)) }}</span>
          <h4 class="mb-5 text-left"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h4>
          <p class="text-left truncate-3-lines">{{ $post->short_description }}</p>
          <a href="/posts/{{ $post->slug }}" class="inline-block px-3 py-2 border-2 border-gray-700 rounded hover:text-yellow-500 hover:border-yellow-500">Read more</a>
        </div>
      </div>
      @endif
      @if($loop->iteration==2)
      <div class="pt-5 md:pt-0">
        <div class="tight-img" style="background-image: url({{ asset('images/' . $post->image_url) }})"></div>
        <div class="my-5 text-center">
          <span class="block text-center mb-2 text-gray-500">{{ date('jS M Y',strtotime($post->updated_at)) }}</span>
          <h4 class="mb-5 text-left"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h4>
          <p class="text-left truncate-3-lines">{{ $post->short_description }}</p>
          <a href="/posts/{{ $post->slug }}" class="inline-block px-3 py-2 border-2 border-gray-700 rounded hover:text-yellow-500 hover:border-yellow-500">Read more</a>
        </div>
      </div>
      @endif
      @if($loop->iteration==3)
      <div class="pt-5 md:pt-0">
        <div class="tight-img" style="background-image: url({{ asset('images/' . $post->image_url) }})"></div>
        <div class="my-5 text-center">
          <span class="block text-center mb-2 text-gray-500">{{ date('jS M Y',strtotime($post->updated_at)) }}</span>
          <h4 class="mb-5 text-left"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h4>
          <p class="text-left truncate-3-lines">{{ $post->short_description }}</p>
          <a href="/posts/{{ $post->slug }}" class="inline-block px-3 py-2 border-2 border-gray-700 rounded hover:text-yellow-500 hover:border-yellow-500">Read more</a>
        </div>
      </div>
      @endif
      @if($loop->iteration==4)
      <div class="col-span-2 relative pt-5 md:pt-0">
        <a href="/posts/{{ $post->slug }}">
          <div class="wide-img" style="background-image: url({{ asset('images/' . $post->image_url) }})"></div>
        </a>
        <div>
          <div class="hidden md:block">
            <span class="absolute top-5 left-5 text-white text-base bg-black bg-opacity-75 p-3 rounded">{{ date('jS M Y',strtotime($post->updated_at)) }}</span>
            <h4 class="absolute bottom-0 left-0 right-0 py-5 mb-0 text-center text-white bg-black bg-opacity-75 p-3">
              <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
            </h4>
          </div>
          <div class="my-5 text-center md:hidden">
            <span class="block text-center mb-2 text-gray-500">{{ date('jS M Y',strtotime($post->updated_at)) }}</span>
            <h4 class="mb-5 text-left"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h4>
            <p class="text-left truncate-3-lines">{{ $post->short_description }}</p>
            <a href="/posts/{{ $post->slug }}" class="inline-block px-3 py-2 border-2 border-gray-700 rounded hover:text-yellow-500 hover:border-yellow-500">Read more</a>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
    <div class="mx-auto text-center p-5">
      <a href="/posts" class="bg-green-500 text-white shadow-md rounded-lg border-2 border-green-600 inline-block px-10 py-3 text-xl font-bold hover:bg-green-600">Explore further...</a>
    </div>
  </div>
@endsection