@extends('layouts.app')
@section('content')
<div class="container 2xl:w-4/5 mx-auto py-5 sm:py-10 px-6 bg-white shadow sm:shadow-md">
  <h1>New Post</h1>
  <div>
    <form action="/posts" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="border-2 border-gray-200 bg-gray-100 shadow-md overflow-hidden max-w-4xl mx-auto rounded sm:p-6">
        <div class="px-4 py-5 sm:p-6">
          <div class="grid grid-cols-1 gap-5">
            <div class="">
              <label for="post-title" class="block text-sm font-medium text-gray-700">Post Title</label>
              <input type="text" name="post_title" id="post-title" placeholder="Post Title" value="{{ old('post_title') }}" maxlength="100">
              @error('post_title')
                  <div class="validation-message">{{ $message }}</div>
              @enderror
            </div>

            <div class="">
              <label for="short-desc" class="block text-sm font-medium text-gray-700">Short Description</label>
              <textarea id="short-desc" name="short_desc" rows="3" placeholder="Short Description" maxlength="255">{{ old('short_desc') }}</textarea>
              @error('short_desc')
                  <div class="validation-message">{{ $message }}</div>
              @enderror
            </div>

            <div class="">
              <label for="long-desc" class="block text-sm font-medium text-gray-700">Long Description</label>
              <input id="long-desc" type="hidden" name="long_desc" value="{{ old('long_desc') }}" />
              <trix-editor class="bg-white outline-none mt-1 block w-full shadow-sm text-sm border-gray-300 rounded-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400" input="long-desc"></trix-editor>
              @error('long_desc')
                  <div class="validation-message">{{ $message }}</div>
              @enderror
            </div>

            <div class="">
              <label for="image-url" class="block text-sm font-medium text-gray-700">Upload Image</label>
              <input type="file" name="image_url" id="image-url" class="rounded" placeholder="Select a file">
              @error('image_url')
                  <div class="validation-message">{{ $message }}</div>
              @enderror
            </div>

            <div class="">
              <label for="image-caption" class="">Image Caption</label>
              <input type="text" name="image_caption" id="image-caption" placeholder="Image Caption" maxlength="100" value="{{ old('image_caption') }}">
              @error('image_caption')
                  <div class="validation-message">{{ $message }}</div>
              @enderror
            </div>

            <div class="text-right">
              <button class="btn-save" type="submit">Submit</button>
              <button class="btn-cancel" type="reset">Reset</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection