<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;


class UserController extends Controller {
	public function getList(){
        //$data = User::select('id','username','email','level')->orderBy('id','DESC')->get()->toArray();
		return view('admin.user.list');
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
        //$parent = Cate::select('id','name','parent_id')->get()->toArray();
		return view('admin.user.add');
	}
    public function postAdd(UserRequest $request){
    	$user = new User;
        $user->username         = $request->txtUser;
        $user->password         = Hash::make($request->txtPass);
        $user->email            = $request->txtEmail;
        $user->level            = $request->rdoLevel;
        $user->remember_token   = $request->_token;
        $user->save();
    	return redirect()->route('admin.user.list')->with(['flash_Message' => 'Thêm thành viên thành công!','flash_level'=>'success']);
    }

}
