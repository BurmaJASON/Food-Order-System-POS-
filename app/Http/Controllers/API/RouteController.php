<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class RouteController extends Controller
{
    //get all product list
    // public function productList(){
    //     $products = Product::get();


    //     $datas =[
    //        'product'=> $products,
    //     ];

    //     return response()->json($datas, 200);
    // }

    // get all category lsit
    public function categoryList(){
        $category = Category::orderBy('id','desc')->get();
        return response()->json($category, 200);
    }

    //get all the pizza order system data
    public function dataList(){
        $user = User::where('role','user')->get();
        $admin = User::where('role','admin')->get();
        $category = Category::get();
        $product = Product::get();
        $order = Order::get();
        $contact = Contact::get();

        $datas =[
            'users'=>[
                'admin'=>$admin,
                'user'=>$user
            ],
            'categories'=>$category,
            'products'=>$product,
            'orders'=>$order,
            'contacts'=>$contact
        ];

        return response()->json($datas,200);
    }

    //create Category
    public function categoryCreate(Request $request){
        // dd($request->header('headerData'));
        $data =[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];

        $response = Category::create($data);

        return response()->json($response,200);
    }

    //create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);
        $response = Contact::orderBy('created_at','desc')->create($data);

        return response()->json($response,200);

    }

    //delete category with post method
    public function categoryDelete(Request $request){
        $data= Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success'],200);
        };

        return response()->json(['status'=>false,'message'=>'There is no category...'],200);


    }

    //delete category with get method
    public function deleteCategory($id){
        // return $id;
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success','deleteData'=>$data],200);
        };

        return response()->json(['status'=>false,'messaage'=>'There is no category...']);
    }

    //category detail with post method
    public function categoryDetail(Request $request){
        $data= Category::where('id',$request->category_id)->first();

        if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data],200);
        };

        return response()->json(['status'=>false,'message'=>'There is no category...'],400);
    }

     //category detail with get method
     public function detailCategory($id){
        $data= Category::where('id',$id)->first();

        if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data],200);
        };

        return response()->json(['status'=>false,'message'=>'There is no category...'],400);
    }

    //category update
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;

        $dbSource = Category::where('id',$categoryId)->first();

        if(isset($dbSource)){
            $data = $this->getCategoryData($request);

            Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
            return response()->json(['message'=>'Updated Successfully','status'=>true,'category'=>$response],200);
        }

        return response()->json(['status'=>false,'message'=>'There is no category to update...'],500);

    }


    //get contact data
    private function getContactData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name'=>$request->category_name,
            'updated_at'=>Carbon::now()
        ];
    }

    //
}
