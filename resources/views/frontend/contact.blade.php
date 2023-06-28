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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.1122520786776!2d105.78771187520717!3d20.948006790547467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135adcbcf842df5%3A0x1042e055d966bb42!
        2sCoCo%20Mart!5e0!3m2!1svi!2s!4v1686932053946!5m2!1svi!2s"
        style="border:0; width:900px; height:500px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- /container left -->
    <!-- container right -->
    <div class="container-right">
        @php
            $categories = DB::table('categories')->where('parent_id','=',0)->orderBy('id','asc')->get();
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
        <!-- tintuc -->
        @php
            $news = DB::table('news')->orderBy('id','asc')->paginate(5);
        @endphp
        @foreach ($news as $row)
            <div class="row1">
                <a href="#">
                    <img src="{{ asset('upload/news/'.$row->photo)}}" alt="">
                </a>
                <div class="blog-infor">
                    <h4 class="blog-name"><a href="#">{{ $row->name }}</a></h4>
                </div>
            </div>
            @unless ($loop->last)
                <div class="line"></div>
            @endunless
            <!-- /tintuc -->
        @endforeach
    </div>
    <!-- /container right -->
</div>
@endsection