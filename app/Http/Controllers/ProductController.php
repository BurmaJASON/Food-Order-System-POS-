<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
            ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(4);
        // dd($pizzas->toArray());
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //direct pizza createPage
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }
    //pizza create
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);

        //Image store
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']= $fileName;

        Product::create($data);

        return redirect()->route('product#list')->with(['createSuccess'=>'Pizza Created Successfully!']);
    }

    //pizza Delete
    public function delete($id){
        Product::find($id)->delete();
        return back()->with(['deleteSuccess'=>'Pizza Deleted Successfully!']);
    }

    //pizza Edit
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->find($id);
        return view('admin.product.edit',compact('pizza'));
    }

    //pizza direct update Page
    public function updatePage($id){
        $pizza = Product::find($id);
        $categories = Category::select('id','name')->get();
        return view('admin.product.update',compact(['pizza','categories']));
    }

    //pizza update
    public function update($id,Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);

        //for image
        if($request->hasFile('pizzaImage')){
            $dbImage = Product::find($id);
            $dbImage = $dbImage->image;
            //deleting old dbImage
            Storage::delete(['public/'. $dbImage]);

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::find($id)->update($data);
        return redirect()->route('product#list');
    }

    //product validation check
    private function productValidationCheck($request,$action){
        $validateionRules =[
            'pizzaName'=>'required|min:3|unique:products,name,'.$request->id,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',
        ];

        $validateionRules['pizzaImage'] = $action == "create"? "required|mimes:png,jpg,jpeg,webp|file" : "mimes:png,jpg,jpeg,gif,webp|file";

        Validator::make($request->all(),$validateionRules)->validate();
    }
    //request product info
    private function requestProductInfo($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,
        ];
    }
}
