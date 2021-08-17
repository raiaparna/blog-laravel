<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller {

	public function __construct() {
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		if(!empty($request)) {
			$users = User::where('name', 'like', '%'.$request->search.'%')->pluck('id')->toArray();
			// dd(Post::whereIn('user_id',$users)->get());
			// dd($users);
			$posts = Post::where('title', 'like', '%'.$request->search.'%')
					->orWhere('short_description', 'like', '%'.$request->search.'%')
					->orWhere(function($query) use ($users) {
						if(isset($users)) {
							// dd($query->whereIn('user_id',$users)->get());
	            return $query->whereIn('user_id',$users);
						}
	         })
					->orderBy('updated_at', 'DESC')
					->paginate(5);
		} else {
			$posts = Post::orderBy('updated_at', 'DESC')->paginate(5);
		}
		return view('posts.index')->with('posts', $posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'post_title' => 'required|max:100',
			'short_desc' => 'required|max:255',
			'long_desc' => 'required',
			'image_url' => 'required|mimes:jpg,jpeg,png|max:5048',
			'image_caption' => 'required|max:100',
		], [],
		[
			'post_title' => 'Post Title',
			'short_desc' => 'Short Description',
			'long_desc' => 'Long Description',
			'image_url' => 'Image File',
			'image_caption' => 'Image Caption',
		]);

		$slug = str_slug($request->post_title, "-");
		$newImageName = uniqid() . "-" . $slug . "." . $request->image_url->extension();
		$request->image_url->move(public_path('images'), $newImageName);

		Post::create([
			'title' => $request->input('post_title'),
			'slug' => $slug,
			'short_description' => $request->input('short_desc'),
			'long_description' => $request->input('long_desc'),
			'image_url' => $newImageName,
			'image_caption' => $request->input('image_caption'),
			'user_id' => auth()->user()->id,
		]);

		return redirect('/posts')->with('message', "Post has been added!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug) {
		$post = Post::where('slug', $slug)->first();

		$read_duration = Str::readDuration($post->long_description);

		return view('posts.post')
			->with('post', $post)
			->with('read_duration', $read_duration);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($slug) {
		return view('posts.edit')
			->with('post', Post::where('slug', $slug)->first());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $slug) {
		$post = Post::where('slug', $slug)->first();
		$this->validate($request, [
			'post_title' => 'required|max:100',
			'short_desc' => 'required|max:255',
			'long_desc' => 'required',
			'image_caption' => 'required|max:100',
		], [],
		[
			'post_title' => 'Post Title',
			'short_desc' => 'Short Description',
			'long_desc' => 'Long Description',
			'image_caption' => 'Image Caption',
		]);

		$slug_new = str_slug($request->post_title, "-");
		if (isset($request->image_url)) {
			$newImageName = uniqid() . "-" . $slug_new . "." . $request->image_url->extension();
			unlink(public_path('images').'/'.$post->image_url);
			$request->image_url->move(public_path('images'), $newImageName);
		} else {
			$newImageName = $post->image_url;
		}

		Post::where('slug', $slug)
			->update([
				'title' => $request->input('post_title'),
				'slug' => $slug_new,
				'short_description' => $request->input('short_desc'),
				'long_description' => $request->input('long_desc'),
				'image_url' => $newImageName,
				'image_caption' => $request->input('image_caption'),
			]);

		return redirect('/posts')
			->with('message', 'Post has been updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$post = Post::find($id);
		unlink(public_path('images').'/'.$post->image_url);
		$post->delete();

		return redirect('/posts')
			->with('message', 'Post has been deleted');
	}

	public function update_showcase($id) {
		$post = Post::where('showcase_flag', 1)->first();
		$post->showcase_flag = 0;
		$post->save();

		$post = Post::find($id);
		$post->showcase_flag = 1;
		$post->save();

		return back();
	}


}
