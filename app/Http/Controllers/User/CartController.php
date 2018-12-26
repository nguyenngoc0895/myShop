<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;
use App\Model\Product;
use App\Model\ProductAttribute;
use App\Model\Coupon;
use App\Model\Order;

class CartController extends Controller
{
    public function addtoCart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();

        if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }        

        
        $countProducts = DB::table('carts')->where([
            'product_id'     =>$data['product_id'],
            'product_color'  =>$data['product_color'],
            'size'           =>$data['size'],
            'session_id'     =>$session_id,
            ])->count();
            
        $sizeArr = explode('-', $data['size']);

        if($countProducts > 0){
            return redirect()->back()->with('message_error', 'Bạn đã chọn sản phẩm này!');
        }

        $getSKU = ProductAttribute::where(['product_id' => $data['product_id'], 'size' => $sizeArr[1]])->first();

        DB::table('carts')->insert([
            'product_id'     =>$data['product_id'],
            'product_name'   =>$data['product_name'],
            'product_code'   =>$getSKU->sku,
            'product_color'  =>$data['product_color'],
            'price'          =>$data['price'],
            'user_email'     =>$data['user_email'],
            'size'           =>$sizeArr[1],
            'quantity'       =>$data['quantity'],
            'session_id'     =>$session_id,
            
        ]);
       
        
        return redirect('/cart')->with('message_success', 'Một sản phẩm đã thêm thành công vào giỏ hàng của bạn!');
    }

    public function Cart()
    {
        // if(Auth::check()){
        //     $user_email = Auth::user()->email;
        //     $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        // }else{
        // }        
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();

        foreach($userCart as $key => $product)
        {
            $productDetail = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetail->image;
        }
        
        return view('user.inc.product.cart', compact('userCart'));
    }

    public function deleteCartProduct($id)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('carts')->where('id', $id)->delete();
        return redirect()->back()->with('message_success', 'Xóa sản phẩm thành công!');
    }

    public function updateCartQuantity($id, $quantity)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $getProductSKU = DB::table('carts')->where('id', $id)->first();
        $getAttributeStock = ProductAttribute::where('sku', $getProductSKU->product_code)->first();
        $update_quantity = $getProductSKU->quantity+$quantity;
        
        if($getAttributeStock->stock >= $update_quantity){
            DB::table('carts')->where('id', $id)->increment('quantity', $quantity);
            return redirect()->back()->with('message_success', 'cập nhập số lượng sản phẩm thành công!');
        }else{
            return redirect()->back()->with('message_error', 'cập nhập số lượng sản phẩm không thành công!');
        }
    }

    public function applyCoupon(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();

        if($couponCount == 0){
            return redirect()->back()->with('message_error', 'Mã giảm giá không hợp lệ!');
        }else{

            //// with perform other checks like active/inactive, expired,...

            $couponDetail = Coupon::where('coupon_code', $data['coupon_code'])->first();

            ///if coupon is Inactive
            if($couponDetail->status == 0){
                return redirect()->back()->with('message_error', 'Mã giảm giá không hoạt động!');
            }

            // if coupon is Expired
            $expiry_date = $couponDetail->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('message_error', 'Mã giảm giá hết hạn!');
            }

            //// Coupon is Valid for discount

            //get cart total amount
            if(Auth::check()){
                $user_email = Auth::user()->email;
                $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
            }
            
            $total_amount = 0;

            foreach($userCart as $item){
               $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            //check if amount type is fixed or percentage
            if($couponDetail->amount_type == "Fixed"){
                $couponAmount = $couponDetail->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetail->amount/100);
            }

            // Add Coupon code & Amount in Session
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);
            
            return redirect()->back()->with('message_success', 'Phiếu giảm giá áp dụng thành công!');
        }
    }

    
}
