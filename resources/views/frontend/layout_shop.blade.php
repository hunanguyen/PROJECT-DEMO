<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/shop.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo-shortcut.png')}}" type="image/png">
    <script src="{{ asset('frontend/js/jquery-3.6.4.min.js')}}"></script>
    <script src="{{ asset('frontend/js/home.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
    @php
      $minPrice = (int)DB::table('products')->min('p_d');
      $maxPrice = (int)DB::table('products')->max('p_d');
    @endphp
    <!-- wapper -->
    <div class="wrapper">
         <!-- Header -->
         @include('frontend.header')
        <!-- /Header -->
        @yield('do-du-lieu-vao-layout')
        <!-- footer -->
        @include('frontend.footer')
        <!-- footer -->
    </div>
</body>
{{-- lọc sản phẩm --}}
<script>
  $('.price_from').val('{{$minPrice}}');
$('.price_to').val('{{$maxPrice}}');
  $( function() {

    $( "#slider-range" ).slider({
      range: true,
      min: parseInt('{{$minPrice}}'),
      max: parseInt('{{$maxPrice}}'),
      values: [ '{{ $minPrice}}', '{{$maxPrice}}' ],
      slide: function( event, ui ) {
          $( "#amount" ).val("Giá từ: " + addPlus(ui.values[ 0 ]).toString() + " ₫" + "-" + addPlus(ui.values[ 1 ]) + " ₫" );
          $('.price_from').val(ui.values[ 0 ]);
          $('.price_to').val(ui.values[ 1 ]);
      }
    });
    $( "#amount" ).val("Giá từ: " + addPlus($( "#slider-range" ).slider( "values", 0 )).toString() + " ₫" + "-" + addPlus($( "#slider-range" ).slider( "values", 1 )) + " ₫" );
  } );
  function addPlus(nStr)
  {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
  }
  </script>
{{-- /lọc sản phẩm --}}
</html>