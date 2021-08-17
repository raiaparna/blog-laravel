<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index () {
        if(Auth::user()->is_admin == 1){
           return view('admin.index')
                ->with('users', User::orderBy('name', 'DESC')->paginate(25));
       } else {
           return redirect('/');
       }
    }
    public function set_admin($id) {
        $user = User::find($id);
        $user->is_admin = 1;
        $user->save();
        Auth::user()->is_admin = 1;
        return back();
    }
    public function unset_admin($id) {
        if (Auth::user()->id != $id) {
            $user = User::find($id);
            $user->is_admin = 0;
            $user->save();
            Auth::user()->is_admin = 0;
        }
        return back();
    }
}
