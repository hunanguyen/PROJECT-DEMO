<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
class UsersController extends Controller
{
    public function read(Request $request){
        //lấy các bản ghi
        $data = DB::table("users")->orderBy("id","desc")->paginate(4);
        return view("admin.users.read",["data"=>$data]);
    }
    public function update(Request $request,$id){
        //láy 1 bản ghi
        $record = DB::table("users")->where("id","=",$id)->first();
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/users/update-post/'.$id);
        return view("admin.users.create_update",["record"=>$record,"action"=>$action]);
    }
    public function updatePost(Request $request,$id){
        $name = $request->get("name");
        // có thẻ dùng cách khác để lấy giá trị
        $email = request("email");
        $password = $request->get("password");
        //update name
        DB::table("users")->where("id","=",$id)->update(["name"=>$name]);
        //nếu password k rỗng thì update pass
        if($password !=""){
            //mã hoá pas
            $password = Hash::make($password);
            DB::table("users")->where("id","=",$id)->update(["password"=>$password]);
        }
        return redirect(url('backend/users'));
    }
    public function create(Request $request){
        $action = url('backend/users/create-post');
        return view("admin.users.create_update",["action"=>$action]);

    }
    public function createPost(Request $request){
        $name = $request->get("name");
        $email = request("email");
        $password = $request->get("password");
        $password = Hash::make($password);
        //update name
        DB::table("users")->insert(["name"=>$name,"email"=>$email,"password"=>$password]);
        return redirect(url('backend/users'));
    }
    public function delete(Request $request,$id){
        //xoá bản ghi
        $record = DB::table("users")->where("id","=",$id)->delete();
        return redirect('backend/users');
    }
}
