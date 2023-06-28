@extends("frontend.layout_home")
@section('do-du-lieu-vao-layout')
     <!-- hàng item hot deal -->
     <div class="item-hotdeal">
        @php
            $hotProducts = \App\Http\Controllers\Frontend\HomeController::hotProducts();
        @endphp
        @foreach ($hotProducts as $row)
        <!-- sản phẩm -->
        <div class="product" onmouseover="show_add_cart(this)" onmouseout="hide_add_cart(this)">
            <!-- hình ảnh sản phẩm -->
            <div class="product-img">
                <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo) }}" alt=""></a>
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
                <span class="product-price-old">{{ number_format($row->price)}}đ</span>
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
            <!-- tag sản phẩm -->
            <div class="product-tag">
                <div class="product-tag-percent">
                    <span class="label">GIÁ SỐC</span>
                    <div class="percent">-{{ $row->discount}}%</div>
                </div>
                <div class="product-tag-sale">
                    <div class="sale">SALE</div>
                </div>
            </div>
            <!-- /tag sản phẩm -->
        </div>
        <!-- /sản phẩm -->
        @endforeach
    </div>
    <!-- /hàng item hot deal -->

    <!-- Thời trang siêu hot -->
    <div class="fashion-hot">
        <div class="top-menu">
            <div class="content-hot"><a href="../Shop/shop.html">THỜI TRANG SIÊU HOT</a></div>
            <div class="menu">
                @php
                    $categories = DB::table("categories")->where("parent_id","=","0")->orderBy("id","desc")->paginate(4);
                @endphp
                <ul>
                    @foreach ($categories as $row)
                        <li><a href="{{ url("products/category/".$row->id)}}">{{ $row->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row-1"> 
            <div class="adv">
                <div class="banner-fashion-1"><a href="#"><img src="frontend/images/banner_1_fashion.png" alt=""></a></div>
                <div class="banner-fashion-1"><a href="#"><img src="frontend/images/banner_2_fashion.png" alt=""></a></div>
            </div>
            @php
                $fashion_hot = \App\Http\Controllers\Frontend\HomeController::fashionHot();
            @endphp
            
            <nav class="product-row">
                <!-- sản phẩm -->
                @foreach ($fashion_hot as $row)
                <div class="product" onmouseover="show_add_cart(this)" onmouseout="hide_add_cart(this)">
                    <!-- hình ảnh sản phẩm -->
                    <div class="product-img">
                        <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo) }}" alt=""></a>
                    </div>
                    <!-- hình ảnh sản phẩm -->
                    <!-- tên sản phẩm -->
                    <div class="product-name">
                        <h4>
                            <a href="#">{{ $row->name}}</a>
                        </h4>
                    </div>
                    <!-- /tên sản phẩm -->
                    <!-- GIÁ sản phẩm  -->
                    <div class="product-price">
                        <span class="product-price-sale">{{ number_format($row->price - ( $row->price * $row->discount)/100)}}đ</span>
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
                            <div class="percent">-{{ $row->discount}}%</div>
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
    <!-- /Thời trang siêu hot -->
    <!-- đồ điện tử và công nghệ -->
    <div class="product-technology">
        <div class="top-menu">
            <div class="content-hot"><a href="../Shop/shop.html">ĐỒ CHƠI & CÔNG NGHỆ</a></div>
            <div class="menu">
                @php
                    $data = DB::table("categories")->where("parent_id","=","0")->orderBy("id","asc")->paginate(4);
                @endphp
                <ul>
                    @foreach ($data as $row)
                        <li><a href="{{ url("products/category/".$row->id)}}">{{ $row->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row-1"> 
            <div class="adv">
                <div class="banner-fashion-1"><a href="#"><img src="frontend/images/banner_1_tech.jpg" alt=""></a></div>
                <div class="banner-fashion-1"><a href="#"><img src="frontend/images/banner_2_tech.jpg" alt=""></a></div>
            </div>
            <nav class="product-row">
                @php
                    $dochoi_congnghe = \App\Http\Controllers\Frontend\HomeController::getTechnology();
                @endphp
                    <!-- sản phẩm -->
                @foreach ($dochoi_congnghe as $row)
                <div class="product" onmouseover="show_add_cart(this)" onmouseout="hide_add_cart(this)">
                    <!-- hình ảnh sản phẩm -->
                    <div class="product-img">
                        <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo) }}" alt=""></a>
                    </div>
                    <!-- hình ảnh sản phẩm -->
                    <!-- tên sản phẩm -->
                    <div class="product-name">
                        <h4>
                            <a href="#">{{ $row->name}}</a>
                        </h4>
                    </div>
                    <!-- /tên sản phẩm -->
                    <!-- GIÁ sản phẩm  -->
                    <div class="product-price">
                        <span class="product-price-sale">{{ number_format($row->price - ( $row->price * $row->discount)/100)}}đ</span>
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
                    <!-- tag sản phẩm -->
                    <div class="product-tag">
                        <div class="product-tag-percent">
                            <span class="label">GIÁ SỐC</span>
                            <div class="percent">-{{ $row->discount}}%</div>
                        </div>
                        <div class="product-tag-sale">
                            <div class="sale">SALE</div>
                        </div>
                    </div>
                    <!-- /tag sản phẩm -->
                </div>
                <!-- /sản phẩm -->
                @endforeach
                </nav>
        </div>
    </div>
    <!-- /đồ điện tử và công nghệ -->
    <!-- lựa chọn cho bạn -->
    <div class="product-for-you">
        <!-- top -->
        <div class="top-menu">
            <div class="content-hot"><a href="#">LỰA CHỌN CHO BẠN</a></div>
                @php
                    $data = \App\Http\Controllers\Frontend\HomeController::getPaginator();
                @endphp
            <div class="btn">
                {{ $data->render('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- /top -->
        <!-- hàng sản phẩm -->
        <div class="body-row">
            <div class="col-1">
                @php
                    $your_choise = \App\Http\Controllers\Frontend\HomeController::yourChoise();
                @endphp
                @foreach ($your_choise as $row)
                <!-- sản phẩm -->
                <div class="product-1" onmouseover="show_add_cart(this)" onmouseout="hide_add_cart(this)">
                    <!-- hình ảnh sản phẩm -->
                    <div class="product-img">
                        <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo) }}" alt=""></a>
                    </div>
                    <!-- hình ảnh sản phẩm -->
                    <!-- tên sản phẩm -->
                    <div class="product-name">
                        <h4>
                            <a href="#">{{ $row->name}}</a>
                        </h4>
                        {{-- giá sản phẩm --}}
                        <div class="product-price">
                            <span class="product-price-sale">{{ number_format($row->price - ( $row->price * $row->discount)/100)}}đ</span>
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
                    </div>
                   
                </div>
                <!-- /sản phẩm -->
                @endforeach
            </div>

        </div>
        <!-- /hàng sản phẩm -->
    </div>
    <!-- /lựa chọn cho bạn -->
@endsection