<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                return redirect('/admin');
            }
        }
        
            $iphone = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 0)->take(10)->get();
            $mac = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 1)->take(10)->get();
            $ipad = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 2)->take(10)->get();
            $watch = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 3)->take(10)->get();
            $imac = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 4)->take(10)->get();
            $macmini = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 5)->take(10)->get();
            $airpod = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 6)->take(10)->get();
            $accessory = DB::table('product')->orderBy('oldPrice','DESC')->where('type', 7)->take(10)->get();
            $hotsale = DB::table('product')->orderBy('oldPrice','DESC')->where('sale', 1)->take(8)->get();

            $discountTime = DB::table('discount')->first();

            return view('main', [
                'iphone' => $iphone,
                'mac' => $mac,
                'ipad' => $ipad,
                'watch' => $watch,
                'imac' => $imac,
                'macmini' => $macmini,
                'airpod' => $airpod,
                'accessory' => $accessory,
                'hotsale' => $hotsale,
                'discountTime' => $discountTime
            ]);
    }

    public function mail()
    {
        $name = 'John Doe';
        Mail::send('email.test', compact('name'), function ($message) {
            $message->subject('Test Email');
            $message->to('esdcstore7@gmail.com', 'Laravel');
        });
    }
}