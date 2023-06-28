<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// sử dụng QuẻyBuilder thì use đói tượng sau
use DB;
class HomeController extends Controller
{
    //
    public function index(){
        return view("frontend.home");
    }
    public static function hotProducts(){
        $products = DB::table("products")->where("hot","=",1)->orderBy("id","desc")->skip(0)->take(5)->get();
        return $products;
    }
    public static function fashionHot(){
        $products = DB::table("products")->where("fashion_hot","=",1)->orderBy("id","desc")->skip(0)->take(8)->get();
        return $products;
    }
    public static function getTechnology(){
        $products = DB::table("products")->where("dochoi_congnghe","=",1)->orderBy("id","desc")->skip(0)->take(8)->get();
        return $products;
    }
    public static function yourChoise(){
        $products = DB::table("products")->where("dochoi_congnghe","=",1)->orderBy("id","desc")->skip(0)->take(6)->get();
        return $products;
    }
    public static function getPaginator(){
        $data = DB::table("products")->where("id","=","0")->orderBy("id","desc")->paginate(4);
        return $data;
    }
    
}
