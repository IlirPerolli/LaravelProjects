<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //Menyra 1
        //$request->session()->put(['edwin'=>'hello']);
        //Menyra 2
        session(['ilir'=>'student', 'blerim'=>'teacher']);
        //Fshirja e sesionit
        //session()->forget('ilir');
        //session()->flush()//Per mi fshi krejt
        //Nxjerrja e sesionit
        //echo session('ilir');
        //echo session()->get('ilir');
        //echo $request->session()->get('ilir');
       // return $request->session()->all();
       // $request->session()->flash('message', 'Post has been created');
        //return session()->get('message');
       //$request->session()->reflash();//Per ti mbajtur me gjate te dhenat e jo vetem 1 here
       // $request->session()->keep('message');//Mbaje me gjate mesazhin pra keyn
        //return view('home');
    }
}
