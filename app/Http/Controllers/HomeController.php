<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function otpSend()
    {
      $basic  = new \Nexmo\Client\Credentials\Basic('8ddf5f86', 'QDFLoT5NGB320AA3');
      $client = new \Nexmo\Client($basic);
      $code = rand(999999, 100000);
      $verification = $client->message()->send([
        'to' => Auth::user()->phoneNumber,
        'from'  => 'Dream Media',
         'text'  => 'Your verification code is '.$code,
       ]);
       DB::table('users')->where('id', Auth::id())->update(['numberVerify' => $code]);
      return redirect('home')->with('status', 'your code has been sent succesfuly');
    }
    public function phoneNumber(Request $request)
    {
      $prevCode = DB::table('users')->where('id', Auth::id())->value('numberVerify');
      if ($prevCode == $request->code) {
        DB::table('users')->where('id', Auth::id())->update(['numberVerify' => 1]);
        return redirect('/home')->with('status', 'Phone number verified!');
      }else {
        return redirect('/home')->with('danger', 'Code dose not match! TRY AGAIN');
      }
    }
}
