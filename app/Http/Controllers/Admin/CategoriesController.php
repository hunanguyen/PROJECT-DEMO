<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//sử dụng model
use App\Models\Categories;
use DB;
class CategoriesController extends Controller
{
    public function read(Request $request){
        //lấy các bản ghi, phân 4 bản ghi trên 1 trang
        $data = Categories::where("parent_id","=","0")->orderBy("id","desc")->paginate(4);
        return view("admin.categories.read",["data"=>$data]);
    }
    public function update(Request $request,$id){
        //lấy 1 bản ghi
        $record = Categories::where("id","=",$id)->first();
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/categories/update-post/'.$id);
        return view("admin.categories.create_update",["record"=>$record,"action"=>$action]);
    }
    public function updatePost(Request $request,$id){
        $name = $request->get("name");
        $parent_id = $request->get("parent_id");
        //update name
        Categories::where("id","=",$id)->update(["name"=>$name,"parent_id"=>$parent_id]);
        if ($request->hasFile("photo")) {
            // ...
            $file_name = $request->file("photo")->getClientOriginalName();
            $file_name = time() . "_" . $file_name;
            $request->file("photo")->move("upload/categories", $file_name);
            DB::table("categories")->where("id", "=", $id)->update(["photo" => $file_name]);
        }
        return redirect(url('backend /categories'));
    }
    public function create(Request $request){
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/categories/create-post');
        return view("admin.categories.create_update",["action"=>$action]);
    }
        public function createPost(Request $request){
            $name = $request->get("name");
            $parent_id = $request->get("parent_id");
            $display_at_home_page = $request->get("display_at_home_page") != "" ? 1 : 0;
            $photo = "";
            
            // Nếu có upload ảnh
            if ($request->hasFile("photo")) {
                // ...
                $file_name = $request->file("photo")->getClientOriginalName();
                $file_name = time() . "_" . $file_name;
                $request->file("photo")->move("upload/categories", $file_name);
            } else {
                $file_name = null; // Gán giá trị mặc định nếu không có ảnh được upload
            }
            
            // Thêm mới bản ghi
            Categories::insert([
                "name" => $name,
                "parent_id" => $parent_id,
                "photo" => $photo,
                "display_at_home_page" => $display_at_home_page
            ]);
        return redirect(url('backend/categories'));
    }
    public function delete(Request $request,$id){
        //xóa bản ghi
        $record = Categories::where("id","=",$id)->orWhere("parent_id","=",$id)->delete();
        return redirect(url('backend/categories'));
    }
}

