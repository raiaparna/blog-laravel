@extends('layouts.app')
@section('content')
  <div class="container 2xl:w-4/5 mx-auto py-5 md:py-10 px-6 bg-white shadow md:shadow-md">
    <h1>
      {{ $user->name }}
    </h1>
    <div class="md:grid grid-cols-4 gap-15 md:divide-x divide-gray-200 divide-dotted profile">
      <div class="left-panel">
        <ul>
          <li class="">
            <span class="active">Profile</span>
          </li>
          {{-- <li class="">
            <a href="">Following<span>10</span></a>
          </li> --}}
          <li class="">
            <a href="/profile/{{ $user->username }}/posts">Posts<span>{{ $postCount }}</span></a>
          </li>
          @if(isset(Auth::user()->id) && $user->id == Auth::user()->id)
          <li class="">
            <a href="/change-password">Change Password</a>
          </li>
          @endif
        </ul>
      </div>
      <div class="right-panel relative">
        @if(session()->has('message'))
          <div class="text-center mx-auto relative p-4 text-green-500 font-semibold">
            {{ session()->get('message') }}
          </div>
        @endif

        @if(isset(Auth::user()->id) && $user->id == Auth::user()->id)
          <div class="absolute right-10 top-10">
            <a href="/profile/{{ $user->username }}/edit">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-400 hover:text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        @endif

        <div class="general-info">
          <div class="text-center">
            @if(isset($user->image_url))
              <img style="background-image:url({{ asset('images/profile/'.$user->image_url) }})">
            @else
              <img src="{{ asset('images/profile/no-image.png') }}">
            @endif
          </div>
          {{-- <h2 class="text-center my-5">{{ $user->name }}</h2> --}}
          <hr class="my-5">
          @if(isset($user->about))
          <div class="about">
            <h4 class="mb-3">About</h4>
            <p>{!! htmlspecialchars_decode($user->about) !!}</p>
          </div>
          <hr class="mb-5">
          @endif
          <div class="other-info sm:grid grid-cols-2 gap-3">
            <div class="">
              Email: <span>{{ $user->email }}</span>
            </div>
            <div class="">
              Username: <span>{{ $user->username }}</span>
            </div>
            <div class="">
              Mobile: <span>{{ $user->mobile }}</span>
            </div>
            <div class="">
              Joined on: <span>{{ date('jS M Y',strtotime($user->created_at)) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection