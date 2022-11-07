<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class AdminController extends Controller
{

    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        /*
            1. all field must be filled
            2. new and confirm pass must be the same and the length must be greater than 6
            3. clinet old pass must be the same with db pass
            4.password update
        */
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->find($currentUserId);
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword, $dbPassword)){
            User::find($currentUserId)->update([
                'password'=>Hash::make($request->newPassword),
            ]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['passwordChange'=>'Password Changed Successfully!']);
        };

        return back()->with(['notMatch'=>'The Old Password not Match. Try Again!']);

    }

    //ACCOUNT Details
    public function details(){
        return view('admin.account.details');
    }

    //account edit
    public function edit(){
        return view('admin.account.edit');
    }

    //account update
    public function update($id,Request $request){

        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            // 1 get old image name| check => delete
            $dbImage = User::find($id);
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete(['public/', $dbImage]);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('public',$fileName);
            $data['image']= $fileName;//stroing image in database
        }
        User::find($id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated Successfully!']);
    }


    //admin list
    public function list(){
        $admins = User::when(request('key'),function($query){
            if(request()->role == 'user'){
                $query = null;
            }
            $query->orWhere('name', 'like', '%' .request('key'). '%')
                    ->orWhere('email', 'like', '%' .request('key'). '%')
                    ->orWhere('gender', 'like', '%' .request('key'). '%')
                    ->orWhere('address', 'like', '%' .request('key'). '%')
                    ->orWhere('phone', 'like', '%' .request('key'). '%');
                })
                ->where('role','admin')
                ->paginate(3);

        $admins->appends(request()->all());

        return view('admin.account.list',compact('admins'));
    }

    //admin delete
    public function delete($id){
        User::find($id)->delete();
        return back()->with([
            'deleteSuccess'=>'Admin Account Deleted Successfully!'
        ]);
    }

    //admin change Role
    public function changeRole($id){
        $account = User::find($id);
        return view('admin.account.changeRole',compact('account'));
    }

    //admin role admin to user
    public function adminChangeRole(Request $request){
        // logger($request->all());
        $roleUpdate =['role'=>'user'];
        User::where('id',$request->adminId)->update($roleUpdate);
    }

    // //admin change
    // public function change($id,Request $request){
    //     $data = $this->requestUserData($request);
    //     User::find($id)->update($data);

    //     return redirect()->route('admin#list');
    // }

    // direct userlist page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.users.list',compact('users'));
    }

    //change role user to admin
    public function userChangeRole(Request $request){
        // logger($request->all());
        $roleUpdate = [
            'role' => $request->role,
        ];

        User::where('id',$request->userId)->update($roleUpdate);
    }

    //delete user
    public function deleteUser($id){
        User::find($id)->delete();
        return back()->with([
            'deleteSuccess'=> 'User Account Deleted Successfully!'
        ]);
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();
    }

    //request user Data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }

    // request user Data
    private function requestUserData($request){
        return [
            'role' => $request->role,
        ];
    }


    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
            'gender'=>['required'],
            'image'=>'mimes:png,jpg,jpeg,webp|file'

        ])->validate();
    }


}
