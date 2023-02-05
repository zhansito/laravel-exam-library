<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('pages.user.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'email|required|min:4|max:75',
            'password'  => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            $user = User::findOrFail(auth()->user()->id);
            $user->lastvisit_at = date('Y-m-d H:i:s');
            $user->save();

            $items = Item::all();
           
            return redirect()->intended('user/dashboard');

        }

        return back()->withErrors([
            'email' => 'User\'s data not correct',
        ])->onlyInput('email');
    }

    public function create()
    {
        return view('pages.user.register');
    }

    public function store(Request $request)
    {

        // $data = $request->validate([
        //     'first_name' => 'required|max:255',
        //     'last_name' => 'required|max:255',
        //     'email' => 'required|min:4|max:75|email',
        //     'password' => 'required|confirmed',
        //     'birthdate' => 'required|date',
        // ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthdate = $request->birthdate;
        $user->save();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    public function dashboard()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $tags = Tag::all();
        $items = $user->items;

        return view('pages.user.dashboard', compact('items', 'tags'));
    }

    public function get_user(int $id = 0)
    {        
        $user = User::find($id);

        return view('pages.user.show', compact('user'));
    }
}
