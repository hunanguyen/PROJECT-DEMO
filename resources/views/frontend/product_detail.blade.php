
@extends('frontend.layout_detail')
@section('do-du-lieu-vao-layout')
@php
	function getCategoryName($category_id){
		$record = DB::table("categories")->where("id","=",$category_id)->select("name")->first();
		return isset($record->name) ? $record->name : "";
	}
@endphp

    <section>
        <div class="container">
            <div class="menu-bar">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li>
                        <span><i class="fa-solid fa-chevron-right"></i></span>
                        <a href="#">Sản phẩm</a>
                    </li>
                    <li>
                        <span></span><i class="fa-solid fa-chevron-right"></i></span>
                        <a href="#">{{ getCategoryName($record->category_id)}}</a>
                    </li>
                    <li>
                        <span></span><i class="fa-solid fa-chevron-right"></i></span>
                        <a href="#">{{ $record->name}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container">
        <!-- container left -->
        <div class="container-left">
            <!-- product detail -->
            <div class="product-detail">
                <!-- product-detail-left -->
                <div class="product-detail-left">
                    <div class="product-img">
                        <img src="{{ asset('upload/products/'.$record->photo) }}" id="img-main">
                        <ul>
                            <li><a><img src="{{ asset('frontend/images/slection1.jpg')}}" id="img1" onclick="changeImage('img1');"></a></li>
                            <li><a><img src="{{ asset('frontend/images/slection2.jpg')}}" id="img2" onclick="changeImage('img2');"></a></li>
                            <li><a><img src="{{ asset('frontend/images/slection3.jpg')}}" id="img3" onclick="changeImage('img3');"></a></li>
                        </ul>
                    
                
                    </div>
                    <div class="title-sale"><span>Giảm giá</span></div>
                </div>
                <!-- /product-detail-left -->
                <!-- product-detail-right -->
                <div class="product-detail-right">
                    <div class="product-title">
                        <h1 class="product-title">{{ $record->name}}</h1>
                    </div>
                    <div class="product-price">
                        <span>{{ number_format($record->price - ($record->price*$record->discount)/100)}}đ</span>
                        <del>{{ number_format($record->price)}}đ</del>
                    </div>
                    <div class="product-summany">{!! $record->content !!}</div>
                    <form action="{{ url('cart/buy/'.$record->id)}}" method="get">
                        @csrf
                        <div class="soluong">
                            <div class="label">Số lượng:</div>
                            <div class="btn">
                                <button class="btn-1">-</button>
                                 <input type="number" value="1">
                                <button class="btn-2">+</button>
                            </div>
                        </div>
                        <!-- tạo button mua -->
                        <div class="button-action">
                            <button class="btn-buy" type="submit">
                                <span href="">Mua hàng</span>
                                <span class="text-2">Giao hàng miễn phí tận nơi</span>
                            </button>
                            <a href="#" class="contact">
                                <span class="text-1">GỌI ĐẶT HÀNG</span>
                                <span class="text-2">Vui lòng gọi ngay 0986.989.626</span>
                            </a>
                        </div>
                    </form>
                    <!-- /tạo button mua -->
                    
                    <!-- offer -->
                    <div class="offer">
                        <ul>
                            <li>“Thu cũ đổi mới” – cơ hội lên đời siêu phẩm Galaxy S9/S9+</li>
                            <li>Giảm thêm 500.000đ khi thanh toán bằng thẻ tín dụng tại TTMS</li>
                            <li>Giảm ngay 100.000đ khi quét QR Code cùng Mastercard với đơn hàng 1.000.000đ</li>
                        </ul>
                    </div>
                    <!-- /offer -->
                    <!-- product group -->
                    <div class="product-group">
                        <span>Danh mục :
                            @php
                                $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id","desc")->get();
                            @endphp
                            @foreach ($categories as $row)
                                <a href="{{ url('products/category/'.$row->id) }}">{{ $row->name}}</a>
                            @endforeach
                        </span>
                    </div>
                    <!-- /product group -->

                </div>
                <!-- /product-detail-right -->
            </div>
            <!-- product detail -->
            <!-- product tab -->
            <div class="product-tab">
                <div class="title-tab">
                    <ul>
                        <li id="tab1"  onclick="handleClick()">MÔ TẢ SẢN PHẨM</li>
                        <li id="tab2"  onclick="handleClick()">ĐÁNH GIÁ</li>
                    </ul>
                </div>
                <div id="box-tab-1">
                    <div id="content">
                        <span>{!! $record->description !!}</span>
                    </div>
                    <button id="toggle-button" onclick="toggleContent();">Xem tất cả</button>
                </div>
                <div id="box-tab-2" class="hidden">
                    <div class="content-box-tab2">
                        <h1>Đánh giá</h1>
                        <p>Chưa có đánh giá nào</p>
                        <p>Hãy là người đầu tiên nhận xét “{{ $record->name}}”
                        </br>Email của bạn sẽ không được hiển thị công khai. Các trường bắt buộc được đánh dấu *</p>
                        <p>Đánh giá của bạn</p>
                        <form action="{{ route('products.rating') }}" method="post">
                        @csrf
                            <div id="rateYo" style="width: 100px;"></div>
                            <input type="hidden" name="star" id="star">
                            <input type="hidden" name="product_id" value="{{ $record->id}}">
                            <p class="comment-box">
                                <label style="display: block;" for="comment">Nhận xét của bạn*</label>
                                <textarea name="comment" id="comment" cols="45" rows="8" required></textarea>
                            </p>
                            <p class="name-author">
                                <label for="name-author">Tên*</label>
                                <input id="name-author" type="text" name="name" required>
                            </p>
                            <p class="email-author">
                                <label for="email-author">Email*</label>
                                <input id="email-author" type="text" name="email" required>
                            </p>
                            <input type="submit" value="Gửi đi">
                        </form>
                    </div>
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /container left -->
        <!-- container-right -->
        <div class="container-right">
            <!-- các service -->
            <div class="mode-service">
                <div class="item-service">
                    <div><img src="{{ asset('frontend/images/giaohang.png')}}" alt=""></div>
                    <div class="item-service-content">
                        <p>Giao hàng siêu tốc</p>
                        <span>Nhận hàng chỉ trong vòng 24h</span>
                    </div>
                </div>
                <div class="item-service">
                    <div><img src="{{ asset('frontend/images/doitrahang.png')}}" alt=""></div>
                    <div class="item-service-content">
                        <p>7 ngày đổi trả hàng dễ dàng</p>
                        <span>Đổi trả nhanh chóng và dễ dàng</span>
                    </div>
                </div>
                <div class="item-service">
                    <div><img src="{{ asset('frontend/images/baohanh.png')}}" alt=""></div>
                    <div class="item-service-content">
                        <p>Bảo hành chính hãng</p>
                        <span>Bảo hành chính hãng 12 tháng</span>
                    </div>
                </div>
                <div class="item-service">
                    <div><img src="{{ asset('frontend/images/tichdiem.png')}}" alt=""></div>
                    <div class="item-service-content">
                        <p>Tích điểm cùng Cocomart</p>
                        <span>Tích điểm với 5% với Cocomart</span>
                    </div>
                </div>
            </div>
            <!-- /các service -->
            <!-- sản phẩm tương tự -->
            <div class="product-similar">
                <div class="product-similar-title">
                    <h2><a href="#">SẢN PHẨM TƯƠNG TỰ</a></h2>
                </div>
                    <div class="list-product">
                        @php
                            $product = \App\Http\Controllers\Frontend\ProductsController::getProducts();
                        @endphp
                        @foreach ($product as $row)
                        <!-- sản phẩm -->
                            <div class="product">
                                <!-- hình ảnh sản phẩm -->
                                <div class="product-img">
                                    <a href="{{ url('products/detail/'.$row->id)}}"><img src="{{ asset('upload/products/'.$row->photo)}}" alt=""></a>
                                </div>
                                <!-- hình ảnh sản phẩm -->
                                <!-- thông tin sản phẩm -->
                                <div class="product-infor">
                                    <h4>
                                        <a href="#">{{ $row->name}}</a>
                                    </h4>
                                    <div class="product-price">
                                        <span class="product-price-sale">{{ number_format($row->price - ($row->price*$row->discount)/100)}}đ</span>
                                        <del class="product-price-old">{{ number_format($row->price) }}đ</del>
                                    </div>
                                </div>
                                <!-- /thông tin sản phẩm -->
                            </div>
                        <!-- /sản phẩm -->
                        @endforeach
                    </div>
            </div>
            <!-- /sản phẩm tương tự -->
        </div>
        <!-- /container- right -->
    </div>

    <div class="product-same">
        <!-- top -->
        <div class="top-menu">
            <div class="title-menu"><a href="#">SẢN PHẨM CÙNG LOẠI</a></div>
            <div class="btn">
                <i class="fa-solid fa-chevron-left"></i>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
        <!-- /top -->
        <!-- hàng sản phẩm -->
        <div class="row ">
            @foreach ($product as $row)
            <!-- sản phẩm -->
            <div class="product"  onmouseover="show_add_cart(this)" onmouseout="hide_add_cart(this)">
                <!-- hình ảnh sản phẩm -->
                <div class="product-img">
                    <a href="{{ url('products/detail/'.$row->id)}}"><img src="{{ asset('upload/products/'.$row->photo)}}" alt=""></a>
                </div>
                <!-- hình ảnh sản phẩm -->
                <!-- tên sản phẩm -->
                <div class="product-name">
                    <h4>
                        <a href="{{ url('products/detail/'.$row->id)}}">{{ $row->name }}</a>
                    </h4>
                </div>
                <!-- /tên sản phẩm -->
                <!-- GIÁ sản phẩm  -->
                <div class="product-price">
                    <span class="product-price-sale">{{ number_format($row->price - ($row->price*$row->discount)/100)}}đ</span>
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
                        <div class="percent">{{ $row->discount }}</div>
                    </div>
                    <div class="product-tag-sale">
                        <div class="sale">SALE</div>
                    </div>
                </div>
                <!-- /tag sản phaamr -->
            </div>
        
            {{-- /sản phẩm --}}
            @endforeach
        </div>
        <!-- /hàng sản phẩm -->
    </div>
@endsection
@section('js')
    <script>
        $(function () {
 
            $("#rateYo").rateYo({
                rating: 0,
                fullStar: true,
                starWidth: "20px"
            }).on("rateyo.set", function (e, data) {
 
                $('#star').val(data.rating);
            });
        });
    </script>
@endsection
