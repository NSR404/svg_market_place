<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscriber;
use Mail;
use App\Mail\EmailManager;
use App\Models\UserGroup;

class NewsletterController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:send_newsletter'])->only('index');
    }

    public function index(Request $request)
    {
        $data['users']          = User::all();
        $data['subscribers']    = Subscriber::all();
        $data['groups']         =  UserGroup::all();
        return view('backend.marketing.newsletters.index', $data);
    }

    public function send(Request $request)
    {


        if (env('MAIL_USERNAME') != null) {
            $array['view'] = 'emails.newsletter';
            $array['subject'] = $request->subject;
            $array['from'] = env('MAIL_FROM_ADDRESS');
            $array['content'] = $request->content;


            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }

            //sends newsletter to subscribers
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            }
            }
            //sends newsletter to groups
            if ($request->has('groups_emails')) {
                    $groups     =   UserGroup::query()->whereIn('id' , $request->groups_emails)->with('users')->get();
                    foreach ($groups as $group) {
                        foreach($group->users as $user)
                        {
                            try {
                                Mail::to($user->email)->queue(new EmailManager($array));
                            } catch (\Exception $e) {
                                //dd($e);
                            }
                        }
                }
            }
        }
        else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

    	flash(translate('Newsletter has been send'))->success();
    	return redirect()->route('admin.dashboard');
    }

    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = "This is a test email.";

        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(translate('An email has been sent.'))->success();
        return back();
    }
}
