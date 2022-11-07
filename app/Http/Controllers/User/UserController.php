<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact(['pizzas','categories','cart','orders']));
    }

    //user password change Page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request){
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

    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id, Request $request){
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
        return back()->with(['updateSuccess'=>'Admin Account Updated Successfully!']);
    }

    //category filter
    public function filter($id){
        $pizzas = Product::orderBy('created_at','desc')->where('category_id',$id)->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact(['pizzas','categories','cart','orders']));
    }
    //direct pizza details
    public function pizzaDetails($id){
        $pizza = Product::find($id);
        $pizzaList = Product::get();
        return view('user.main.details',compact(['pizza','pizzaList']));
    }

    //cart list direct page
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $cart){
            $totalPrice += $cart->pizza_price * $cart->qty;
        };


        return view('user.cart.cart',compact(['cartList','totalPrice']));
    }

    //clear item with remove btn
    public function clearItem($id){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice = 0;
        foreach($cartList as $cart){
            $totalPrice += $cart->pizza_price * $cart->qty;
        };

        Cart::where('id',$id)->delete();

        return redirect()->route('user#cartList',compact(['cartList','totalPrice']));
    }

    //history page
    public function history(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(4);

        return view('user.main.history',compact('orders'));
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();
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
}
