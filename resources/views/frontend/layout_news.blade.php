<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/news.css')}}">
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo-shortcut.png')}}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('frontend/css/main.js')}}"></script>
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
        <!-- /Header -->
        <!-- container -->
        @yield('do-du-lieu-vao-layout')
        <!-- /container -->
        <!-- footer -->
        @include('frontend.footer')
        <!-- footer -->
    </div>
    <!-- wapper -->
</body>
</html>