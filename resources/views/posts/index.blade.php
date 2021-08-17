@extends('layouts.app')
@section('content')
  <div class="container 2xl:w-4/5 mx-auto py-5 md:py-10 px-6 bg-white shadow md:shadow-md relative">
    <h1>
      Blog Posts
      @if(isset($profilename))
        of {{ $profilename }}
      @endif
    </h1>

    @if(Auth::check())
    <div class="absolute right-10 top-10">
      <a href="/posts/create" class="btn-new">+</a>
    </div>
    @endif

    <div class="m-auto divide-y divide-gray-200">
      @if(session()->has('message'))
        <div class="text-center mx-auto relative p-4 text-green-500 font-semibold">
          {{ session()->get('message') }}
        </div>
      @endif

    <div>
      <form class="w-full max-w-sm" method="get" action="/posts">
        <div class="flex items-center pt-2 pb-5">
          <input class="w-full text-black mr-3 p-2" type="text" placeholder="Search by Title/Short Description/Author" name="search" value="{{ old('search') }}">
          <button class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
            Search
          </button>
        </div>
      </form>
    </div>
    {{-- Posts start --}}
      @foreach($posts as $post)
        @if ($loop->even)
          <div class="md:flex flex-1 flex-row-reverse gap-15 py-5 md:py-10">
        @else
          <div class="md:flex flex-1 gap-15 py-5 md:py-10">
        @endif
            <div class="md:w-1/3">
              <div class="tight-img mb-3 md:mb-0" style="background-image: url({{ asset('images/' . $post->image_url) }})"></div>
            </div>
            <div class="md:w-2/3">
              <p class="post-info">
                <a href="/profile/{{ $post->user->username }}" class="link">{{ $post->user->name }}</a>
                <span class="padd">/</span>
                {{ date('jS M Y',strtotime($post->updated_at)) }}
                <span class="padd"></span>
                @if(isset(Auth::user()->id) && $post->user_id == Auth::user()->id)
                  <div class="inline-block">
                    <a href="/posts/{{ $post->slug }}/edit" class="btn-edit">Edit</a>
                  </div>
                  <div class="inline-block">
                    <a data-id="{{ $post->id }}" href="" class="btn-delete modal-open">Delete</a>

                        {{-- <a href="/posts/delete/{{ $post->id }}" class="btn-delete">Delete</a> --}}
                    {{-- <form action="/posts/{{ $post->id }}" method="POST" style="display: inline">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn-delete">Delete</button>
                    </form> --}}
                  </div>
                @endif
              </p>
              <h2 class="post-heading"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
              <p class="post-snippet">
                {{ $post->short_description }}
              </p>
              <a href="/posts/{{ $post->slug }}" class="read-more">Read more</a>
            </div>
          </div>
      @endforeach
        {{-- Posts end --}}

      {{-- Pagination --}}
      <div class="flex justify-center post-pagination">
          {{ $posts->links() }}
      </div>

      <!--Modal-->
      <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
          
          <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
          </div>

          <!-- Add margin if you want to see some of the overlay behind the modal-->
          <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
              <p class="text-2xl font-bold">Delete Post</p>
              <div class="modal-close cursor-pointer z-50">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
              </div>
            </div>
            <form action="" method="POST" id="form-delete">
              @csrf
              @method('delete')

              <!--Body-->
              <p>Are you sure you want to Delete Post?</p>

              <!--Footer-->
              <div class="flex justify-end pt-2">
                <button type="submit" class="btn-destroy mr-2">Delete</button>
                <button type="button" class="modal-close btn-cancel">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection