<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
   {
    # code...
    return view('admin.admin_login');

}

   public function Dashboard()
   {
    # code...
    return view('admin.index');
   }

   public function Login(Request $request)
   {
    # code...
  $check = $request->all();
  if(Auth::guard('admin')->attempt(['email'=>$check['email'],'password'=>$check['password']])){
    return redirect()->route('admin.dashboard')->with('error','Admin Login successfully');

  }
  else{
    return back()->with('error',  'invalid Email Or Password');


  }
   }

   public function AdminRegister()
   {
    # code...
    return view('admin.admin_register');
   }

   public function AdminRegisterCreate(Request $request)
   {
    # code...
    //dd($request->all());
    Admin::insert([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
        'created_at'=> Carbon::now(),
     ]);
     return redirect()->route('login_form')->with('error','Admin register successfully');

   }
   public function AdminLogout()
   {
    # code...
    Auth::guard('admin')->logout();
    return redirect()->route('login_form')->with('error','Admin Logout successfully');

   }
}
