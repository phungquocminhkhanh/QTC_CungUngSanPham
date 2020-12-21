<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Mail;
use Symfony\Component\DomCrawler\Form;
class GmailController extends Controller
{
    public function gui_otp(Request $request)
    {
        /*$input = $request->all();
        Mail::send('mailfb', array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['comment']), function($message){
	        $message->to('hanhan160598@gmail.com', 'Hân')->subject('Visitor Feedback!');
	    });
        Session::flash('flash_message', 'Send message successfully!');

        return view('pages.form'); 
*/
        /*$request->tenkh;
        $request->emailkh;
        $request->idbd;
        $request->maotp;*/
        /*$a = $request->maotp;
        $b= 'hanhan160598@gmail.com';*/
        $arrEmail = [$request->emailkh];
        $data = ['mail'=>$request->emailkh,'otp' => $request->maotp];
 		Mail::send('pages.gmail_otp',$data,function($message) use ($arrEmail){
 			 $message->from('hanhan160598@gmail.com', 'BDS SaiGonHome')->subject('Visitor Feedback!');
 			 $message->to($arrEmail[0])->subject('MÃ XÁC NHẬN OTP');
	    });
        Session::flash('flash_message', 'Send message successfully!');
    
	
    }

  
} 