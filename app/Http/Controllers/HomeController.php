<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMailable;
use Response;
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
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application mail send.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageMail()
    {
        return view('mails.send');
    }
    /**
     * Show the application mail send.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send(Request $request)
    {
        $mailData = array(
                   'name'     => $request->name,
                   'email'     => $request->email,
                   'message'     => $request->message,
                  );
        Mail::to('sarojbaskota379@gmail.com')->send(new SendMailable($mailData));
         $response = array(
                'status' => 'success',
                'msg' => 'Mail  successfully Send Thank You!!',
        );
        return Response::json($response);
    }
}
