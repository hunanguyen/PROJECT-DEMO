<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{
    public static function getNews(){
        $news = DB::table('news')->orderBy('id','asc')->paginate(5);
        return view('frontend.news',['news'=>$news]);
    }
    public static function newsDetail($id){
        $record = DB::table('news')->where('id','=',$id)->first();
        return view('frontend.news_detail',['record'=>$record]);
    }

}
