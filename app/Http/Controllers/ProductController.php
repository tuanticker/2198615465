<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Cate;
use App\Product;

class ProductController extends Controller {

	public function getList(){
        $data = Cate::select('id','name','parent_id')->orderBy('id','DESC')->get()->toArray();
		return view('admin.cate.list',compact('data'));
	}
    public function getDelete($id){
        $parent = Cate::where('parent_id',$id)->count();
        if($parent == 0){
            $cate = Cate::find($id);
            $cate->delete($id);
            return redirect()->route('admin.cate.list')->with(['flash_Message' => 'Xóa danh mục thành công!','flash_level'=>'success']);
        }else{
            echo "<script type='text/javascript'>
                alert('Không thể xóa danh mục này!');
                window.location = '";
                echo route('admin.cate.list');
            echo "'
            </script>";
        }
    }
    public function getEdit($id){
        $data = Cate::findOrFail($id)->toArray();
        $parent = Cate::select('id','name','parent_id')->get()->toArray();
        return view('admin.cate.edit',compact('parent','data'));
    }
    public function postEdit(Request $request,$id){
        $cate = Cate::find($id);
        $cate->name        = $request->txtCateName;
        $cate->alias       = string_to_alias($request->txtCateName);
        $cate->order       = $request->txtOrder;
        $cate->parent_id   = $request->selectCateParent;
        $cate->keywords    = $request->txtKeywords;
        $cate->description = $request->textDescription;
        $cate->save();
        return redirect()->route('admin.cate.list')->with(['flash_Message' => 'Sửa danh mục thành công!','flash_level'=>'success']);
    }
    

	public function getAdd(){
        $cate = Cate::select('id','name','parent_id')->get()->toArray();
		return view('admin.product.add',compact('cate'));
	}
    public function postAdd(ProductRequest $request){
       $file_name = $request->file('fImages')->getClientOriginalName();
    	$product = new Product;
    	$product->name        = $request->txtName;
    	$product->alias       = string_to_alias($request->txtName);
    	$product->price       = $request->txtPrice;
    	$product->intro       = $request->txtIntro;
    	$product->content     = $request->txtContent;
        $product->image       = $file_name;
        $product->keywords    = $request->txtKeywords;
    	$product->description = $request->textareaDescription;
        $product->user_id     = 1;
        $product->cate_id     = $request->selectCateParent;
        $request->file('fImages')->move('resources/upload/products/images',$file_name);
    	$product->save();
    	// return redirect()->route('admin.product.list')->with(['flash_Message' => 'Thêm danh mục thành công!','flash_level'=>'success']);
    }
}
