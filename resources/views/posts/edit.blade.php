@extends('layouts.app')
@section('content')
<div class="container 2xl:w-4/5 mx-auto py-5 sm:py-10 px-6 bg-white shadow sm:shadow-md">
  <h1>Edit Post</h1>
  <div>
    <form action="/posts/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="border-2 border-gray-200 bg-gray-100 shadow overflow-hidden max-w-4xl mx-auto rounded sm:p-6">
        @if ($errors->any())
            <div class="text-red-500 text-center py-3 px-6 font-semibold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="px-4 py-5 sm:p-6">
          <div class="grid grid-cols-1 gap-5">
            <div class="">
              <label for="post-title" class="block text-sm font-medium text-gray-700">Post Title</label>
              <input type="text" name="post_title" id="post-title" maxlength="100" value="{{ $post->title }}">
            </div>

            <div class="">
              <label for="short-desc" class="block text-sm font-medium text-gray-700">Short Description</label>
              <textarea id="short-desc" name="short_desc" rows="3" maxlength="255">{{ $post->short_description }}</textarea>
            </div>

            <div class="">
              <label for="long-desc" class="block text-sm font-medium text-gray-700">Long Description</label>
              <input id="long-desc" type="hidden" name="long_desc" value="{{ $post->long_description }}" />
              <trix-editor class="bg-white outline-none mt-1 block w-full shadow-sm text-sm border-gray-300 rounded-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400" input="long-desc"></trix-editor>
              {{-- <textarea id="long-desc" name="long_desc"></textarea> --}}
            </div>

            <div class="">
              <label for="image-url" class="block text-sm font-medium text-gray-700">Upload Image</label>
              <input type="file" name="image_url" id="image-url" class="rounded" placeholder="Select a file">
            </div>

            <div class="">
              <label for="image-caption" class="">Image Caption</label>
              <input type="text" name="image_caption" id="image-caption"  maxlength="100" value="{{ $post->image_caption }}">
            </div>

            <div class="text-right">
              <button class="btn-save" type="submit">Save</button>
              <a href="/posts" class="btn btn-cancel">Cancel</a>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection