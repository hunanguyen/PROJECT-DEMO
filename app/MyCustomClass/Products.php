<?php 
namespace App\MyCustomClass;
use DB;
use Request;
class Products{
	public function modelRead(){
		$data = DB::table("products")->orderBy("id","desc")->paginate(50);
		return $data;
	}
	public static function getCategoryName($category_id){
		$record = DB::table("categories")->where("id","=",$category_id)->first();
		return isset($record->name) ? $record->name : "";
	}
	public function modelGetRow($id){
		$record = DB::table("products")->where("id","=",$id)->first();
		return $record;
	}
	public function modelUpdate($id){
		$name = Request::get("name");
		$category_id = Request::get("category_id");
		$price = Request::get("price");
		$discount = Request::get("discount");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$fashion_hot = Request::get("fashion_hot") != "" ? 1 : 0;
		$dochoi_congnghe = Request::get("dochoi_congnghe") != "" ? 1 : 0;
		$your_choise = Request::get("your_choise") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$p_d = $price - ($price * $discount)/100;
		//update bản ghi
		DB::table("products")->where("id","=",$id)->update(["p_d"=>$p_d,"name"=>$name,"category_id"=>$category_id,
		"description"=>$description,"content"=>$content,"hot"=>$hot,"fashion_hot"=>$fashion_hot,
		"dochoi_congnghe"=>$dochoi_congnghe,"your_choise"=>$your_choise,"price"=>$price,"discount"=>$discount]);
		//nếu có upload ảnh thì update
		if(Request::hasFile("photo")){
			//---
			//lấy ảnh cũ để xóa
			$record = DB::table("products")->where("id","=",$id)->first();
			if(file_exists('upload/products/'.$record->photo))
				unlink('upload/products/'.$record->photo);//xóa ảnh
			//---
			$file_name = Request::file("photo")->getClientOriginalName();
			$file_name = time()."_".$file_name;
			Request::file("photo")->move("upload/products",$file_name);
			DB::table("products")->where("id","=",$id)->update(["photo"=>$file_name]);
		}
	}
	public function modelCreate(){
		$name = Request::get("name");
		$category_id = Request::get("category_id");
		$price = Request::get("price");
		$discount = Request::get("discount");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$fashion_hot = Request::get("fashion_hot") != "" ? 1 : 0;
		$dochoi_congnghe = Request::get("dochoi_congnghe") != "" ? 1 : 0;
		$your_choise = Request::get("your_choise") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$photo = "";
		$p_d = $price - ($price * $discount)/100;
		//nếu có upload ảnh
		if(Request::hasFile("photo")){
			$file_name = Request::file("photo")->getClientOriginalName();
			$photo = time()."_".$file_name;
			Request::file("photo")->move("upload/products",$photo);
		}
		//create bản ghi
		DB::table("products")->insert(["p_d"=>$p_d,"name"=>$name,"category_id"=>$category_id,"description"=>$description,"content"=>$content,"hot"=>$hot,"fashion_hot"=>$fashion_hot,"dochoi_congnghe"=>$dochoi_congnghe,"your_choise"=>$your_choise,"photo"=>$photo,"price"=>$price,"discount"=>$discount]);
		
	}
	public function modelDelete($id){
		//---
		//lấy ảnh cũ để xóa
		$record = DB::table("products")->where("id","=",$id)->first();
		if(file_exists('upload/products/'.$record->photo))
			unlink('upload/products/'.$record->photo);//xóa ảnh
		//---
		//xóa bản ghi
		DB::table("products")->where("id","=",$id)->delete();
	}
}