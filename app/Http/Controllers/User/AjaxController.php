<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'new'){
            $data = Product::orderBy('created_at','desc')->get();
        }
        else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

    //giving data to cart
    public function addToCart(Request $request){
        $data = $this->getCartData($request);
        // logger($data);
        Cart::create($data);
        $response =[
            'message'=>'success',
        ];
        return response()->json($response,200);
    }

    //order list
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create($item);
            $total += $data->total;
        };

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id'=> Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000,
        ]);

        return response()->json([
            'message'=>'order completed'
        ],200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'message'=>'order completed'
        ],200);
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();

        $updateCount = [
            'view_count' => $pizza->view_count+ 1,
        ];

        Product::where('id',$request->productId)->update($updateCount);

    }


    //getting order data
    private function getCartData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),

        ];
    }

}
