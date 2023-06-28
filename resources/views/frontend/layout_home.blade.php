<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Cocomart</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo-shortcut.png')}}" type="image/png">
    <script src="{{ asset('frontend/js/jquery-3.6.4.min.js')}}"></script>
    <script src="{{ asset('frontend/js/home.js') }}"></script>
</head>
<body>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6497c6c094cf5d49dc5fad66/1h3oe0p1l';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <!-- wapper -->
    <div class="wrapper">
        <!-- Header -->
        @include('frontend.header')
        @include('frontend.side')
        <!-- content -->
        <div class="content">
            <h2>
            <a href="#"><span class="hotdeal">HOT DEAL</span>GIÁ SỐC</a>
            </h2>
        </div>
        <!-- /content -->
        <!-- container -->
        <div class="container">
           @yield('do-du-lieu-vao-layout')
        </div>
        <!-- /container -->
        <!-- Nhãn hiệu -->
        <div class="brand">
            <!-- content nhãn hiệu -->
            <div class="brand-content">
                <h2>
                    <a href="#"><span>CÁC NHÃN HIỆU ĐƯỢC ƯA CHUỘNG</span></a>
                </h2>
            </div>
            <!-- /content nhãn hiệu -->
            <!-- logo nhãn hieeuj -->
            <div class="brand-logo">
                <div><img src="frontend/images/logo-coyote.png" alt=""></div>
                <div><img src="frontend/images/logo-sharp.png" alt=""></div>
                <div><img src="frontend/images/logo-walmart.png" alt=""></div>
                <div><img src="frontend/images/logo-compal.png" alt=""></div>
                <div><img src="frontend/images/logo-berloni.png" alt=""></div>
                <div><img src="frontend/images/logo-redmart.png" alt=""></div>
            </div>
            <!-- /logo nhãn hieeuj -->
        </div>
        <!-- /Nhãn hiệu -->
        <!-- dịch vụ -->
        <div class="service">
            <div class="service-box">
                <!-- item service -->
                <div class="service-box-item">
                    <div class="service-icon">
                        <img src="frontend/images/pig.png" alt="">
                    </div>
                    <div class="service-content">
                        <div class="service-content-title">Mua hàng siêu tiết kiệm1</div>
                        <div class="service-content-">Các sản phẩm luôn được bán với giá ưu đã nhất cho khách hàng</div>
                    </div>
                </div>
                <!-- /item service -->
                <!-- item service -->
                <div class="service-box-item">
                    <div class="service-icon">
                        <img src="frontend/images/like.png" alt="">
                    </div>
                    <div class="service-content">
                        <div class="service-content-title">Chất lượng tuyệt đối 100%</div>
                        <div class="service-content-">Cam kết sản phẩm chính hãng từ Châu Âu, Châu Mỹ...</div>
                    </div>
                </div>
                <!-- /item service -->
                <!-- item service -->
                <div class="service-box-item">
                    <div class="service-icon">
                        <img src="frontend/images/tag.png" alt="">
                    </div>
                    <div class="service-content">
                        <div class="service-content-title">Khuyến mãi cực lớn</div>
                        <div class="service-content-">Được hưởng ưu đãi và các chương trình khuyến mại cực lớn</div>
                    </div>
                </div>
                <!-- /item service -->
                <!-- item service -->
                <div class="service-box-item">
                    <div class="service-icon">
                        <img src="frontend/images/card.png" alt="">
                    </div>
                    <div class="service-content">
                        <div class="service-content-title">Thanh toán dễ dàng</div>
                        <div class="service-content-">Phương thức thanh toán đa dạng và cực kì tiện lợi</div>
                    </div>
                </div>
                <!-- /item service -->
            </div>
        </div>
        <!-- /dịch vụ -->
      @include('frontend.footer')
    <!-- /warpper -->
    </div>

</body>
</html