<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //FOR USER
    //direct contact page
    public function contactPage(){
        return view('user.contact.contactPage');
    }

    //create contact
    public function createContact(Request $request){
        $currentUserId = Auth::user()->id;
        $user = User::select('email','name')->find($currentUserId);
        // dd($user->email);

        if($request->userEmail != $user->email || $request->userName != $user->name){
            $this->contactValidationCheck($request);
            return redirect()->route('user#contactPage')->withErrors(['failedEmail'=>'The username or email entered is invalid.Please Try Again!']);
        }else{
            $data = $this->contactData($request);
            Contact::create($data);
            return redirect()->route('user#home')->with(['sendSuccess'=>'Your Message is sent Successfully!']);
        }
    }

    //FOR ADMIN
    //direct user response page
    public function message(){
        $messages = Contact::orderBy('created_at','desc')->paginate(4);
        return view('admin.contact.responses',compact('messages'));
    }

    //delete messages
    public function deleteMessage($id){
        Contact::find($id)->delete();
        return back()->with(['deleteSuccess'=>'Message Deleted Successfully!']);

    }

    //read message
    public function messageDetail($id){
        $message = Contact::find($id);
        return view('admin.contact.messageDetail',compact('message'));
    }

    //contact Validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'userName'=>'required|min:4|',
            'userEmail'=>'required',
            'userMessage'=>'required|min:5|',
        ])->validate();
    }

    //contact data
    private function contactData($request){
        return [
            'name'=>$request->userName,
            'email'=>$request->userEmail,
            'message'=>$request->userMessage,
        ];
    }

}
