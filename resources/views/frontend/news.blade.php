@extends('frontend.layout_news')
@section('do-du-lieu-vao-layout')
 <!-- Section -->
 <section>
    <div class="container">
        <div class="menu-bar">
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li>
                <span><i class="fa-solid fa-chevron-right"></i></span>
                    <a href="#" style="color: #eb3e32">Tin tức</a>
                </li>
                
            </ul>
        </div>
    </div>
</section>
<!-- /Section -->
<div class="container">
    <div class="content-left">
     
        <h1>TIN TỨC</h1>
        <!-- tintuc1 -->
        @foreach ($news as $index => $row)
            <div class="row">
                <a href="{{ url('news/detail/'.$row->id)}}">
                    <img src="{{ asset('upload/news/'.$row->photo)}}" alt="">
                </a>
                <div class="blog-infor">
                    <h2 class="blog-name"><a href="{{ url('news/detail/'.$row->id)}}">{{ $row->name }}</a></h2>
                    <div class="date">
                        @php
                            $date = \Carbon\Carbon::parse($row->date);
                            $monthInVietnamese = $date->format('F');
                            
                            $vietnameseMonths = [
                                'January' => 'Tháng một',
                                'February' => 'Tháng hai',
                                'March' => 'Tháng ba',
                                'April' => 'Tháng tư',
                                'May' => 'Tháng năm',
                                'June' => 'Tháng sáu',
                                'July' => 'Tháng bảy',
                                'August' => 'Tháng tám',
                                'September' => 'Tháng chín',
                                'October' => 'Tháng mười',
                                'November' => 'Tháng mười một',
                                'December' => 'Tháng mười hai',
                            ];
                            
                            $vietnameseMonth = $vietnameseMonths[$monthInVietnamese];
                        @endphp
                    <i class="fa-regular fa-clock"></i></i>{{ $vietnameseMonth }},
                    <div class="time">{{ date("d/m/Y", strtotime($row->date)) }}</div>
                    <div class="count-blog">
                            <i class="fa-solid fa-user"></i> Đăng bởi admin
                    </div>
                    </div>
                    <div class="sumary">{!! $row->content !!}</div>
                </div>
            </div>
            @if (!$loop->last)
                <div class="line"></div>
            @endif
        @endforeach
        <!-- /tintuc1 -->
    </div>
    <!-- /container left -->
    <!-- container right -->
    <div class="container-right">
        @php
            $categories = DB::table('categories')->where('parent_id','=','0')->orderBy('id','asc')->get();
        @endphp
        <!-- danh muc -->
        <div class="title-list">
            <h2>DANH MỤC</h2>
        </div>
        <div class="content-list">
            <ul>
                @foreach ($categories as $row)
                    <li>
                        <img src="{{ asset('upload/categories/'.$row->photo) }}" alt="">
                        <a href="#">{{ $row->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /danh muc -->
        <!-- -->
        <h2>TIN TỨC</h2>
        <!-- tintuc1 -->
        @foreach ($news as $row)
            <div class="row1">
                <a href="{{ url('news/detail/'.$row->id)}}">
                    <img src="{{ asset('upload/news/'.$row->photo)}}" alt="">
                </a>
                <div class="blog-infor">
                    <h4 class="blog-name"><a href="{{ url('news/detail/'.$row->id)}}">{{ $row->name }}</a></h4>
                </div>
            </div>
            @unless ($loop->last)
                <div class="line"></div>
            @endunless
            <!-- /tintuc1 -->
        @endforeach
    </div>
    <!-- /container right -->
</div>
@endsection