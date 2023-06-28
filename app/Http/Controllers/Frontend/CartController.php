<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\ShoppingCart\Cart;
class CartController extends Controller

{
    // kế thừa class cart
  
    //thêm sản phẩm vào giỏ hàng
    public function buy(Request $request,$id){
        // gọi hsmf cartAdd từ classs Cart
        Cart::cartAdd($id);
        return redirect(url("cart"));
    }
    //hiển thị danh sách giỏ hàng
    public function index(){
        //lấy giỏ hàng
        $cart = Cart::cartList();
        return view("frontend.cart",["cart"=>$cart]);
    }
    //xoá sản phẩm khỏi giỏ hàng
    public function remove($id){
        Cart::cartDelete($id);
        return redirect(url("cart"));
    }
    //xáo all
    public function destroy(){
        Cart::cartDestroy();
        return redirect(url("cart"));   
    }
    //cập nhật số lượng sản phảm
    public function update(){
        //lấy giỏ hàng
        $cart = Cart::cartList();
        //duyệt các phần tử trong  session cart
        foreach($cart as $product){
            $name = "product_".$product['id'];
            $new_quantity = $_POST[$name];
            //gọi hàm CartUpdate để update lại số lượng sản phẩm
            Cart::cartUpdate($product['id'],$new_quantity);
        }
        return redirect(url('cart'));
    }
    //thanh toán
    public function order(){
        //kiểm tra xem user đã đang nhập chưa, nếy chưa thì đề nghị ddanwg nhập
        $customer_id = session()->get('customer_id');
        if(isset($customer_id)){
            //gọi hàm cartOder để thanh toán đơn hàng và xoá toàn bộ giỏ hàng
            Cart::cartOrder();
            return redirect(url("cart"));
        }else
            return redirect(url("customers/login"));
    }
}

