<?php 
namespace App\MyCustomClass;
use DB;
use Request;
class News{
	public function modelRead(){
		$data = DB::table("news")->orderBy("id","desc")->paginate(50);
		return $data;
	}
	public function modelGetRow($id){
		$record = DB::table("news")->where("id","=",$id)->first();
		return $record;
	}
	public function modelUpdate($id){
		$name = Request::get("name");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$date = now();
		//update bản ghi
		DB::table("news")->where("id","=",$id)->update(["name"=>$name,"date"=>$date,"description"=>$description,"content"=>$content,"hot"=>$hot]);
		//nếu có upload ảnh thì update
		if(Request::hasFile("photo")){
			//---
			//lấy ảnh cũ để xóa
			$record = DB::table("news")->where("id","=",$id)->first();
			if(file_exists('upload/news/'.$record->photo))
				unlink('upload/news/'.$record->photo);//xóa ảnh
			//---
			$file_name = Request::file("photo")->getClientOriginalName();
			$file_name = time()."_".$file_name;
			Request::file("photo")->move("upload/news",$file_name);
			DB::table("news")->where("id","=",$id)->update(["photo"=>$file_name]);
		}
	}
	public function modelCreate(){
		$name = Request::get("name");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$date = now();
		$photo = "";
		//nếu có upload ảnh
		if(Request::hasFile("photo")){
			$file_name = Request::file("photo")->getClientOriginalName();
			$photo = time()."_".$file_name;
			Request::file("photo")->move("upload/news",$photo);
		}
		//create bản ghi
		DB::table("news")->insert(["name"=>$name,"date"=>$date,"description"=>$description,"content"=>$content,"hot"=>$hot,"photo"=>$photo]);
		
	}
	public function modelDelete($id){
		//---
		//lấy ảnh cũ để xóa
		$record = DB::table("news")->where("id","=",$id)->first();
		if(file_exists('upload/news/'.$record->photo))
			unlink('upload/news/'.$record->photo);//xóa ảnh
		//---
		//xóa bản ghi
		DB::table("news")->where("id","=",$id)->delete();
	}
}