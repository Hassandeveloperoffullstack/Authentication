<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
           $i = 1 ;
        // $users = User::get()->where('role','customer');
        $users = DB::table('users')->where('role','customer')->where('delete',0)->get();
        return view('admin\Dashboard',['data'=> $users , 'i'=> $i]);
        // return $users;

    //  return view('admin\Dashboard');
    }

    public function updatePage(string $id)
    {
        $data = DB::table('users')->where('id',$id)->get();
        return view('admin/updateuser',compact('data'));
        
    }
    public function update(Request $req ,$id)
    {
        $user = DB::table('users')
        ->where('id',$id)
        ->update([
            'name'=>$req->name,
            'email'=>$req->email
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User Updated Successfully !');
    }
    public function delete(string $id)
    {
        $user = DB::table('users')
        ->where('id',$id)
        ->update([
            'delete'=> 1
        ]);

        Auth::logout();

        return redirect()->route('admin.dashboard')->with('success', 'User Deleted Successfully !');
    }
    public function block(string $id)
    {
        $user = DB::table('users')
        ->where('id',$id)
        ->update([
            'block'=> 1
        ]);
        Auth::logout();


        return redirect()->route('admin.dashboard')->with('success', 'User Blocked Successfully !');
    }
    public function unblock(string $id)
    {
        $user = DB::table('users')
        ->where('id',$id)
        ->update([
            'block'=> 0
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User Un-blocked Successfully !');
    }

}