<?php

namespace App\Http\Controllers;
use App\Models\Post;

class PagesController extends Controller {
	public function index() {
		return view('index')
			->with('showcase', Post::where('showcase_flag', 1)->first())
			->with('posts', Post::where('showcase_flag', 0)->orderBy('updated_at', 'DESC')->limit(4)->get());
	}
}
