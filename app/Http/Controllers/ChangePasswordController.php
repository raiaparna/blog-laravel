<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
// use Illuminate\Support\Facades\Auth;
use Auth, Hash;

class ChangePasswordController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $postCount = Post::where('user_id', Auth::id())->get()->count();
        return view('auth.passwords.changePassword')
            ->with('postCount', $postCount);
    }

    public function changePassword(Request $request) {

        //form data
        /*$data = $request->all();
        $user::where($data);

        return back()->with('message', 'Password successfully changed!');*/

        $this->validate($request, [
          'current_password' => 'required',
          'password' => 'required|required_with:password_confirmation|string|confirmed',
        ]);
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('message', 'Password successfully changed!');
    }
}
