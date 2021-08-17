@extends('layouts.app')
@section('content')
<div class="container 2xl:w-4/5 mx-auto py-5 md:py-10 px-6 bg-white shadow md:shadow-md">
  <h1>
    Change Password
  </h1>
  <div class="md:grid grid-cols-4 gap-15 md:divide-x divide-gray-200 divide-dotted profile">
    <div class="left-panel">
      <ul>
        <li class="">
          <a href="/profile/{{ Auth::user()->username }}">Profile</a>
        </li>
        <li class="">
          <a href="/profile/{{ Auth::user()->username }}/posts">Posts<span>{{ $postCount }}</span></a>
        </li>
        @if(isset(Auth::user()->id))
        <li class="">
          <span class="active">Change Password</span>
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
      @if(session()->has('error'))
        <div class="text-center mx-auto relative p-4 text-red-500 font-semibold">
          {{ session()->get('error') }}
        </div>
      @endif
      <div>
        <form action="/change-password" method="POST">
          @csrf
          <div class="border-2 border-gray-200 bg-gray-100 shadow-md overflow-hidden max-w-xl mx-auto rounded sm:p-6">
            <div class="px-4 py-5 sm:p-6">
              <div class="grid grid-cols-1 gap-5">
      
                <div class="">
                  <label for="current-password" class="block text-sm font-medium text-gray-700">Current Password</label>
                  <input type="password" id="current-password" name="current_password" value="{{ old('current_password') }}">
                  @error('current_password')
                      <div class="validation-message">{{ $message }}</div>
                  @enderror
                </div>

                <div class="">
                  <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                  <input type="password" id="password" name="password" value="{{ old('password') }}">
                  @error('password')
                      <div class="validation-message">{{ $message }}</div>
                  @enderror
                </div>

                <div class="">
                  <label for="password-confirm" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                  <input type="password" id="password-confirm" name="password_confirmation" value="{{ old('password_confirmation') }}">
                  @error('password_confirmation')
                      <div class="validation-message">{{ $message }}</div>
                  @enderror
                </div>

                <div class="text-right">
                  <button class="btn-save" type="submit">Save</button>
                  <button class="btn-cancel" type="reset">Reset</button>
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