@extends('frontend.layout_shop')
@section('do-du-lieu-vao-layout')
@php
    $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id","desc")->get();
@endphp
    <section>
        <div class="container">
            <div class="row-new">
                <div class="menu-bar">
                    <ul>
                        @foreach ($categories as $row)
                            
                        @endforeach
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>
                        <span><i class="fa-solid fa-chevron-right"></i></span>
                            <a href="{{ url('products/category/'.$row->id) }}">Sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /Section -->
    {{-- container --}}
    <div class="container">
        <!-- container left -->
        <div class="container-left">
            <!-- danh muc -->
                <div class="title-list">
                    <h2>DANH MỤC</h2>
                </div>
                <div class="content-list">
                    @php
                        $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id","desc")->get();
                    @endphp
                    <ul>
                        @foreach ($categories as $row)
                        <li>
                            <img src="{{ asset('upload/categories/'.$row->photo)}}" alt="">
                            <a href="{{ url('products/category/'.$row->id) }}">{{ $row->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            <!-- /danh muc -->
            <!-- box search -->
            <div class="slide-price">
                <form method="GET" action="{{ asset('products/searchPrice') }}">
                    <div class="title-slide">
                        <h4>MỨC GIÁ:</h4>
                    </div>
                    <div id="slider-range"></div>   
                    <input type="hidden" class="price_from" name="fromPrice">
                    <input type="hidden" class="price_to" name="toPrice">
                    <div class="filter">
                        <input type="submit" value="Lọc" class="button">
                        <input type="text" id="amount" readonly class="label-price" disabled>
                    </div>
                </form>
            </div>
          <!-- end box search -->
            <!-- /mức giá -->
            <!-- Sale hot -->
            <div class="sale-hot">
                <h3>KHUYẾN MÃI HOT</h3>
                <img src="{{ asset('frontend/images/khuyenmai.png')}}" alt="">
            </div>
            <!-- /Sale hot -->
        </div>
        <!-- /container left -->
        <!-- container right -->
        <div class="container-right">
            <div class="title-head">
                <div class="title-head-left">
                    <h2>Hiển thị các sản phẩm có giá từ: {{ number_format($fromPrice) }}đ - đến {{ number_format($toPrice) }}đ</h2>
                </div>
                <div class="title-head-right">
                 
                </div>
            </div>
            <div class="product-list">
                <div class="row-1"> 
                
                    <nav class="product-row1">
                        @foreach ($data as $row)
                        <!-- sản phẩm -->
                        <div class="product" onmouseover="show_add_cart(this)" onmouseout="hide_add_cart(this)">
                            <!-- hình ảnh sản phẩm -->
                            <div class="product-img">
                                <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo)}}" alt=""></a>
                            </div>
                            <!-- hình ảnh sản phẩm -->
                            <!-- tên sản phẩm -->
                            <div class="product-name">
                                <h4>
                                    <a href="{{ url('products/detail/'.$row->id) }}">{{ $row->name}}</a>
                                </h4>
                            </div>
                            <!-- /tên sản phẩm -->
                            <!-- GIÁ sản phẩm  -->
                            <div class="product-price">
                                <span class="product-price-sale">{{ number_format($row->price - ($row->price * $row->discount)/100) }}đ</span>
                                <span class="product-price-old">{{ number_format($row->price) }}đ</span>
                            </div>
                            <!-- /GIÁ sản phẩm  -->
                            <!-- thêm vào giỏ hàng -->
                            <div class="product-show-buy">
                                <div class="add-cart">
                                    <div class="buy-product">
                                        <a href="{{ url('cart/buy/'.$row->id)}}">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                    </div>
                                    <div class="view-port">
                                        <a href=""><i class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /thêm vào giỏ hàng -->
                            <!-- tag sản phaamr -->
                            <div class="product-tag">
                                <div class="product-tag-percent">
                                    <span class="label">GIÁ SỐC</span>
                                    <div class="percent">{{ $row->discount}}%</div>
                                </div>
                                <div class="product-tag-sale">
                                    <div class="sale">SALE</div>
                                </div>
                            </div>
                            <!-- /tag sản phaamr -->
                        </div>
                        <!-- /sản phẩm -->
                        @endforeach
                    </nav>
                </div>
            </div>
                <!-- chuyển trang sảm phẩm -->
            <div class="page-number">
                {{ $data->render('vendor.pagination.bootstrap-4')}}
            </div>
            <style>
                .pagination {
                    list-style: none;
                    margin: 0px;
                    padding: 0px;
                }
                .pagination a{
                    text-decoration: none;
                    line-height: 1.5;
                }
            </style>
            <!-- /chuyển trang sảm phẩm -->
        </div>
        <!-- /container right -->
    </div>
    {{-- /container --}}

@endsection