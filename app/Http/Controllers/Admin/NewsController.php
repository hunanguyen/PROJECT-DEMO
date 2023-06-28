<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//khai báo class News
use App\MyCustomClass\News;

class NewsController extends Controller{
	public $model;
	public function __construct(){
		$this->model = new News();
	}
	public function read(){
		$data = $this->model->modelRead();
		return view("admin.news.read",["data"=>$data]);
	}
	public function update($id){
		$record = $this->model->modelGetRow($id);
		$action = url("backend/news/update-post/$id");
		return view("admin.news.create_update",["record"=>$record,"action"=>$action]);
	}
	public function updatePost($id){
		$this->model->modelUpdate($id);
		return redirect(url("backend/news"));
	}
	public function create(){
		$action = url("backend/news/create-post/");
		return view("admin.news.create_update",["action"=>$action]);
	}
	public function createPost(){
		$this->model->modelCreate();
		return redirect(url("backend/news"));
	}
	public function delete($id){
		$this->model->modelDelete($id);
		return redirect(url("backend/news"));
	}
}