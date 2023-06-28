<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\URL;

//để sử dụng Query Builder cần phải use đối tượng sau
use DB;

class ProductsController extends Controller
{
    public function category($category_id){          
         
        $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("id","desc")->paginate(8);
        //lấy giá trị truyền từ url
        $order = request('order'); 
        switch ($order) {
            case 'nameAsc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("name","asc")->paginate(8);
                break;
            case 'nameDesc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("name","desc")->paginate(8);
                break;
            case 'priceAsc':    
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("price","asc")->paginate(8);
                break;
            case 'priceDesc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("price","desc")->paginate(8);
                break;
        }
        return view("frontend.product_category",["category_id"=>$category_id,"data"=>$data,'order'=>$order]);
    }
    public function detail($id){
        $record = DB::table("products")->where("id","=",$id)->first();
        return view("frontend.product_detail",["record"=>$record]);
    }
    public static function getProducts(){
        $product = DB::table("products")->orderBy("id","asc")->paginate(4);
        return $product;
    }
    public static function getCategory($category_id){
        $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("id","desc")->paginate(2);
        return view("frontend.product_detail",["data"=>$data,"category_id"=>$category_id]);
    }
    public function search(Request $request)
    {
        $key = $request->input('key');
    
        $data = DB::table('products')
            ->select('id', 'name', 'description', 'content','photo','price','discount')
            ->where('name', 'like', '%'.$key.'%')
            ->orWhere('description', 'like', '%'.$key.'%')
            ->orWhere('content', 'like', '%'.$key.'%')
            ->distinct()
            ->get();
    
        $data = collect($data)->unique('name')->values();
        
    
        $perPage = 40;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $data->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentItems, $data->count(), $perPage, $currentPage);
    
        return view('frontend.product_search', compact('key', 'data'));
    }
    
    public function ajax()
    {
        $key = request('key');
        $data = DB::table('products')
            ->where('name', 'like', '%' . $key . '%')
            ->orWhere('description', 'like', '%' . $key . '%')
            ->orWhere('content', 'like', '%' . $key . '%')
            ->select('name', 'id', 'photo')
            ->get();
    
        $uniqueData = $data->unique('name');
    
        $str = "";
        foreach ($uniqueData as $row) {
            $str .= "<li><img src='" . asset('upload/products/' . $row->photo) . "'> 
            <a href='" . url('products/detail/' . $row->id) . "'>" . $row->name . "</a></li>";
        }
    
        echo $str;
    }
    
     //đánh giá sao sản phẩm
     public function rating(Request $request){
        
        Rating::create($request->only('star','product_id','name','email','comment'));
        
        return redirect()->back();

    }
    public function searchPrice(Request $request){
        $fromPrice = request('fromPrice');
        $toPrice = request('toPrice');
        $data = DB::table('products')->whereBetween('p_d',[$fromPrice,$toPrice])->paginate(40);
        return view('frontend.product_search_price',['fromPrice'=>$fromPrice,'toPrice'=>$toPrice,'data'=>$data]);
    }
 
}
