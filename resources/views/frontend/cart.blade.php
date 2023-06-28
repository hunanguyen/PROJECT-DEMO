@extends('frontend.layout_shop')
@section('do-du-lieu-vao-layout')
    @php
        use App\Http\ShoppingCart\Cart;
    @endphp
        <!-- section -->
        <section>
            <div class="container">
                <div class="menu-bar">
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li>
                            <span><i class="fa-solid fa-chevron-right"></i></span>
                            <a href="{{ asset('cart')}}">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /Section -->
    @if (isset($cart))
        <!-- giỏ hàng -->
        <form action="{{ url('cart/update')}}" method="post">
            @csrf
            <div class="cart-detail">
                <h1>Giỏ hàng</h1>
                <table class="product-cart">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Hình ảnh</th>
                            <th>Tên Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($cart as $product)
                        <tr>
                            <td class="product-remove">
                                <a href="{{ url('cart/remove/'.$product['id']) }}">x</a>
                            </td>
                            <td>
                                <a href="{{ url('products/detail/'.$product['id']) }}"><img src="{{ asset('upload/products/'.$product['photo']) }}" alt=""></a>
                            </td>
                            <td class="name-product">
                                <a href="{{ url('products/detail/'.$product['id']) }}">{{ $product['name']}}</a>
                            </td>
                            <td class="price-product">
                                <span>{{ number_format($product['price'] - ($product['price'] * $product['discount'])/100) }}₫</span>
                                
                            </td>
                            <td>
                                <input type="number" id="qty" min="1" class="input-control" value="{{ $product['quantity'] }}"
                                    name="product_{{ $product['id'] }}" required="Không thể để trống">
                            </td>
                            <td class="price-product">
                                <span>{{ number_format($product['quantity'] * ($product['price'] - ($product['price'] * $product['discount'])/100)) }}₫</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <td colspan="6">
                            <div class="foot">
                                <div class="left">
                                    <input type="text" placeholder="Mã ưu đãi">
                                    <button type="button">Áp dụng</button>
                                </div>
                                @if (Cart::cartNumber() > 0)
                                    <div class="right">
                                        <input type="submit" class="button pull-right" value="Cập nhật giỏ hàng"></td>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tfoot>
                </table>
            </div>
        </form>
        <!-- /giỏ hàng -->
        @if (Cart::cartNumber() > 0)
            <!-- tổng tiền -->
            <div class="cart-total">
                <div class="total-price">
                    <h1>Tổng số tiền</h1>
                    <table>
                        <tbody>
                            <tr class="top">
                                <th>Tổng phụ</th>
                                <td class="price-product">
                                    <span>{{ number_format(Cart::cartTotal())}}đ</span>
                                </td>
                            </tr>
                            <tr class="bottom">
                                <th>Tổng</th>
                                <td class="price-product">
                                    <span>{{ number_format(Cart::cartTotal())}}đ</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pay">
                        <a href="{{ url('cart/order')}}">Thanh toán sản phẩm</a>
                    </div>
                </div>
            </div>
            <!-- /tổng tiền -->
        @endif
    @endif
@endsection