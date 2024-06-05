<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('Login');
    }


    public function authenticate(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'email' => 'required | email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            $user = DB::table('users')->where('email', $req->email)->first();
            if ($user) {
                $users = DB::table('users')->where('email', $req->email)->get();

                if ($users->first()->block == 0) {
                    if ($users->first()->delete == 0) {
                        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
                            return redirect()->route('account.dashboard');
                        } else {
                            return redirect()->route('account.login')->withInput()->with('error', 'Either password or email is incorrect !');
                        }
                    } else {

                        return redirect()->route('account.login')->with('error', 'Your Account has bee deleted!');
                    }
                } else {
                    return redirect()->route('account.login')->with('error', 'Your Account has bee blocked!');
                }
            } else {
                return redirect()->route('account.login')->withInput()->with('error', 'Either password or email is incorrect !');
            }
        } else {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }

    public function register()
    {


        return view('Register');
    }
    public function processRegister(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->role = 'customer';
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect()->route('account.login')->with('success', 'You have successfully registered !');
        } else {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
