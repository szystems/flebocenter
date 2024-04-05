<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Config;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class FrontendController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('frontend.index', compact('config'));
    }

    public function aboutus()
    {
        $config = Config::first();
        return view('frontend.aboutus', compact('config'));
    }

    public function contact()
    {
        $config = Config::first();
        return view('frontend.contact', compact('config'));
    }

    public function sendcontactemail(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $mensaje = $request->input('mensaje');

        $config = Config::first();

        Mail::to($config->email)->send(new ContactMail($name, $email, $phone, $subject, $mensaje));

        $request->session()->flash('alert-success', "Tu mensaje se ha enviado, muchas gracias por comunicarte con Asonata Xela");

        return view('frontend.contact', compact('config'));
    }


}
