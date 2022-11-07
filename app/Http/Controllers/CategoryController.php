<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list page
    public function list(){
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->orderBy('id','desc')
          ->paginate(4);

        $categories->appends(request()->all());

        return view('admin.category.list',compact('categories'));
    }

    //category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category Created Successfully']);
    }

    //delete
    public function delete($id){
        Category::find($id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted Successfully!']);
    }

    //edit page
    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    //update
    public function update($id,Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list');
    }

    //category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|min:4|unique:categories,name,'.$request->id,
        ])->validate();
    }

    //request category data
    private function requestCategoryData($request){
        return ['name'=>$request->categoryName];
    }
}
