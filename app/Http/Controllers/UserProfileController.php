<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserProfileController extends Controller
{

  public function __construct() {
    $this->middleware('auth', ['except' => ['show']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
      $user = User::where('username', $username)->first();
      return view('posts.index')
        ->with('posts', Post::where('user_id',$user->id)->orderBy('updated_at', 'DESC')->paginate(5))
        ->with('profilename',$user->name);

      // return view('posts.index')
      //   ->with('posts', Post::orderBy('updated_at', 'DESC')->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
      $user = User::where('username', $username)->first();
      $post_count = Post::where('user_id', $user->id)->get()->count();
      return view('profile.profile')
          ->with('user', $user)
          ->with('postCount', $post_count);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
      $user = User::where('username', $username)->first();
      $post_count = Post::where('user_id', $user->id)->get()->count();
        return view('profile.edit')
          ->with('user',$user)
          ->with('postCount', $post_count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        $this->validate($request, [
          'name' => 'required|max:100',
          'email' => 'required|max:100|email:rfc,dns|unique:users,email,'.$user->id,
          'username' => 'required|max:20|unique:users,username,'.$user->id,
          'about' => 'max:1500',
          'mobile' => 'max:22',
          'image_url' => 'mimes:jpg,jpeg,png|max:5048',
        ], [],
        [
          'name' => 'Name',
          'email' => 'Email',
          'username' => 'Username',
          'about' => 'About',
          'mobile' => 'Mobile no.',
          'image_url' => 'Image',
        ]);

        if(isset($request->image_url)) {
          if(isset($user->image_url)) {
            unlink(public_path('images/profile').'/'.$user->image_url);
          }
          $newImageName = uniqid() . "-" . $request->username . "." . $request->image_url->extension();
          $request->image_url->move(public_path('images/profile'), $newImageName);
        } else {
          if(isset($user->image_url)) {
            $newImageName = $user->image_url;
          } else {
            $newImageName = null;
          }
        }

        User::find($user->id)
          ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'about' => $request->input('about'),
            'mobile' => $request->input('mobile'),
            'image_url' => $newImageName,
          ]);

          return redirect('/profile/'.$request->input('username'))
            ->with('message', 'Profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
