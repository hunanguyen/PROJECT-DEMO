<div class="header">
    <!-- header top -->
    <div class="header-top">
    <!-- header top bên trái -->
        <div class="header-top-left">
            <ul>
                <li><a href="#">Chào mừng bạn đến với Cocomart!</a></li>
                <li><a href="#">Mở cửa: 8h00 - 22h00, thứ 2 - CN hàng tuần</a></li>
            </ul>
        </div>
            <!-- /header top bên trái -->
        <!-- header top bên phải  -->
        <div class="header-top-right">
            @php
                $customer_email = session()->get('customer_email');
            @endphp
            @if(isset($customer_email))      
                <div class="customer"> <a href='#'>Xin chào {{ $customer_email }}</a>&nbsp; &nbsp;<a href="{{ url('customers/logout') }}">Đăng xuất</a> </div>
            @else
                <div class="customer">
                    <a href="{{ url('customers/login') }}">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Đăng nhập</span>
                    </a>
                    <a href="{{ url('customers/register') }}">
                    <i class="fa-brands fa-creative-commons-by"></i>
                    <span>Đăng kí</span>
                    </a>
                </div>
            @endif
             <div class="hot-sale">
                <a href="#">
                     <i class="fa-sharp fa-solid fa-star"></i>
                     <span>Khuyến mãi hot</span>
                 </a>
             </div>
             <div class="system-shop">
                 <a href="#"><i class="fa-solid fa-location-dot"></i>
                     <span>Hệ thống của hàng</span>
                 </a>
             </div>
        </div>
    </div>
        <!-- /header top bên phải  -->
        <!-- /header top -->
        <!-- header giữa -->
    <div class="header-main">
        <!-- Logo website -->
        <div class="logo">
            <a href="{{ url('/')}}"><img src="{{ asset('frontend/images/logo.png')}}" alt=""></a>
        </div>
        <!-- /logo website -->
        <!-- Tìm kiếm sản phẩm  -->
        <div class="seach">
                <!-- ô nhập dữ  -->
                <input type="text" onkeyup="ajaxSearch();" onkeypress="searchForm(event);" id="key" placeholder="Bạn đang tìm kiếm sản phẩm nào ?">
                <!-- /ô nhập dữ  -->
                <!-- Button -->
                <button type="submit"  onclick="location.href='{{ url('products/search') }}?key='+document.getElementById('key').value;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <!-- /Button -->
                <div class="search-result">
                    <ul>
                    </ul>
                </div>
        </div>
        <!-- /Tìm kiếm sản phẩm  -->
        <style type="text/css">
            .header-search{position: relative;}
            .search-result{position: absolute; z-index: 10; top: 100px; visibility:hidden;}
            .search-result ul{padding:0px; margin:0px; list-style: none; width: 400px; background: white; max-height: 200px; overflow: scroll;}
            .search-result ul li{border-bottom: 1px solid #dddddd; display: flex;}
            .search-result img{width: 40px;}
            .search-result ul li a{ text-decoration: none;}
          </style>
        <script>
        function searchForm(event){
            //nếu là phím enter thì sẽ di chuyển đến trang tìm kiếm
            if(event.which == 13)
              location.href = '{{ url('products/search') }}?key='+document.getElementById('key').value;
            }
            function ajaxSearch(){
                let key = document.getElementById('key').value;
                if(key != ''){
                    //hiển thị search result
                    $(".search-result").attr('style','visibility:visible');
                    //---
                    $.ajax({
                    url: "{{ url('products/ajax-search') }}?key="+key,
                    success: function( result ) {
                        //clear content trong thẻ ul
                        $('.search-result ul').empty();
                        $('.search-result ul').append(result);
                    }
                    });
                    //---
                }else
                    $(".search-result").attr('style','visibility:hidden');
                }
        </script>
        <!-- hotline và giỏ hàng -->
        <div class="phone-cart">
            <!-- số hotline -->
            <div class="phone">
                <div class="icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="contact">
                    <a href="#">0986.989.626</a>
                    <div>Hotline đặt hàng</div>
                </div>
            </div>
            <!-- /số hotline -->
            <!-- giỏ hàng -->
            <div class="cart">
                <div class="icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                @php
                    use App\Http\ShoppingCart\Cart;
                @endphp
                <div class="contact">
                    <a href="{{ asset('cart')}}">({{Cart::cartNumber()}}) Sản phẩm</a>
                    <div>Giỏ hàng</div>
                </div>
            </div>
            <!-- /giỏ hàng -->
        </div>
        <!-- /hotline và giỏ hàng -->
    </div>
    <!-- /header giữa -->
    <!-- header cuối -->
    <div class="header-bottom">
        <nav class="header-bottom-list"><span><i class="fa-sharp fa-solid fa-bars"></i>Danh mục sản phẩm</span>
            <ul class="sub-menu">
                @php
                    $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id","desc")->get();
                @endphp
                @foreach ($categories as $row)
                <li id="item-sub-menu" class="thoitrangnu">
                    <a class="sub" href="{{ url('products/category/'.$row->id) }}"><img src="{{asset('upload/categories/'.$row->photo)}}" alt="">{{ $row->name}}</a>
                    @php
                    $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id","desc")->get();
                    @endphp
                    @foreach($subCategories as $subRow)
                        <div class="sub-menu-small">
                            <ul class="sub-menu1">
                                <li><div class="tamgiac"></div></li>
                                @foreach($subCategories as $subRow)
                                <li class="sub1">
                                    <a class="tiltle" href="{{ url('products/category/'.$subRow->id) }}">{{ $subRow->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endforeach
            </ul>
        </nav>
        <nav class="header-bottom-menu">
            <ul class="nav-menu">
                <li id="item-bottom-menu"><a class="tiltle" href="{{ url('/')}}">Trang chủ</a></li>
                <li id="item-bottom-menu"><a class="tiltle" href="">Giới thiệu</a></li>
                <li id="item-bottom-menu" class="sanpham">
                    <a class="tiltle" href="{{ url('products/category/'.$row->id) }}">
                    <span>Sản phẩm</span>
                    <i class="fa-solid fa-sort-down"></i>
                    </a>
                    <ul class="sub-product1">
                        @foreach ($categories as $index =>$row)
                            
                        @if ($index >= 0 && $index <= 3)
       
                        <li class="diengiadung"><a href="{{ url('products/category/'.$row->id) }}">{{ $row->name }}</a>
                            <ul class="sub-product2">
                                @foreach ($categories as $index =>$row)
                                @if ($index >= 4 && $index <= 9)
                                
                                <li><a href="{{ url('products/category/'.$row->id) }}">{{$row->name}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                <li id="item-bottom-menu"><a class="tiltle" href="{{ url('/news')}}"> Tin tức</a></li>
                <li id="item-bottom-menu"><a class="tiltle" href="{{ url('/contact')}}">Liên hệ</a></li>
            </ul>
        </nav>
    </div>
    <!-- /header cuối -->
</div>
<!-- /Header -->