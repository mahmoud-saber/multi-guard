<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
   public function index()
   {
    # code...
    return view('seller.seller_login');
   }

   public function SellerDashboard()
   {
    # code...
    return view('seller.index');
   }

   public function SellerLogin(Request $request)
   {
    # code...
    $check = $request->all();
    if(Auth::guard('seller')->attempt(['email'=>$check['email'],'password'=>$check['password']])){
      return redirect()->route('seller.dashboard')->with('error','Seller Login successfully');

    }
    else{
      return back()->with('error',  'invalid Email Or Password');
    }

    }

    public function SellerRegister()
    {
     # code...
     return view('seller.seller_register');
    }

    public function SellerRegisterCreate(Request $request)
   {
    # code...
    //dd($request->all());
    Seller::insert([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
        'created_at'=> Carbon::now(),
     ]);
     return redirect()->route('seller_login_form')->with('error','Seller register successfully');

   }

   public function SellerLogout()
   {
    # code...
    Auth::guard('admin')->logout();
    return redirect()->route('seller_login_form')->with('error','Seller Logout successfully');

   }
}
