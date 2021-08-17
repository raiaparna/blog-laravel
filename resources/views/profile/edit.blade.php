@extends('layouts.app')
@section('content')
  <div class="container 2xl:w-4/5 mx-auto py-5 md:py-10 px-6 bg-white shadow md:shadow-md">
    <h1>
      Edit Profile ({{ $user->name }})
    </h1>
    <div class="md:grid grid-cols-4 gap-15 md:divide-x divide-gray-200 divide-dotted profile">
      <div class="left-panel">
        <ul>
          <li class="">
            <a href="/profile/{{ $user->username }}" class="active">Profile</a>
          </li>
          <li class="">
            <a href="/profile/{{ $user->username }}/posts">Posts<span>{{ $postCount }}</span></a>
          </li>
        </ul>
      </div>
      <div class="right-panel relative">
        <div>
          <form action="/profile/{{ $user->username }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="border-2 border-gray-200 bg-gray-100 shadow-md overflow-hidden max-w-xl mx-auto rounded sm:p-6">
              <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-5">

                  <div class="mx-auto text-center">
                    @if(isset($user->image_url))
                      <img style="background-image:url({{ asset('images/profile/'.$user->image_url) }})" class="w-40 h-40 rounded-full bg-no-repeat bg-center bg-cover border-2 border-gray-200 shadow" id="display-image">
                    @else
                      <img src="{{ asset('images/profile/no-image.png') }}" class="w-40 h-40 rounded-full" id="display-image">
                    @endif
                    <label for="display-image" class="block text-sm font-medium text-gray-700">Profile Image</label>
                  </div>

                  <div class="">
                    <label for="image-url" class="block text-sm font-medium text-gray-700">Upload Profile Image</label>
                    <input type="file" name="image_url" id="image-url" class="rounded" placeholder="Select a file">
                    @error('image_url')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                  </div>
 
                  <div class="">
                    <label for="Name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="Name" value="{{ $user->name }}" maxlength="100">
                    @error('name')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" maxlength="100">
                    @error('email')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ $user->username }}" maxlength="100">
                    @error('username')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="">
                    <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile No.</label>
                    <input type="text" name="mobile" id="mobile" value="{{ $user->mobile }}" placeholder="Mobile no." maxlength="100">
                    @error('mobile')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="">
                    <label for="about" class="block text-sm font-medium text-gray-700">About me</label>
                    <input id="about" type="hidden" name="about" value="{{ $user->about }}" />
                    <trix-editor class="bg-white outline-none mt-1 block w-full shadow-sm text-sm border-gray-300 rounded-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400" input="about"></trix-editor>
                    @error('long_desc')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="text-right">
                    <button class="btn-save" type="submit">Save</button>
                    <a href="/profile/{{ $user->username }}" class="btn btn-cancel">Cancel</a>
                  </div>

                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection