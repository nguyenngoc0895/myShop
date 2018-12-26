<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Model\User;
use App\Model\Cart;
use App\Model\Product;
use App\Model\Country;
use App\Model\Delivery_address;
use App\Model\Order;
use App\Model\OrderProduct;
use DB;

class ProcessOrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetail = User::find($user_id);
        $countries = Country::get();
        $shippingCount = Delivery_address::where('user_id', $user_id)->count();
        $shippingDetail = array();

        if($shippingCount > 0 ){
            $shippingDetail = Delivery_address::where('user_id', $user_id)->first();
        }

        $session_id = Session::get('session_id');
        Cart::where('session_id', $session_id)->update(['user_email' => $user_email]);

        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(empty($data['billing_name']) || empty($data['billing_country']) || empty($data['billing_city']) || empty($data['billing_state']) || empty($data['billing_address']) || empty($data['billing_phone_number']) || empty($data['shipping_name']) || empty($data['shipping_country']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_address']) || empty($data['shipping_phone_number']))
            {
                return redirect()->back()->with('message_error', 'Vui lòng điền đầy đủ thông tin!');
            }

            User::where('id', $user_id)->update([
                'name' => $data['billing_name'],
                'country' => $data['billing_country'],
                'city' => $data['billing_city'],
                'state' => $data['billing_state'],
                'address' => $data['billing_address'],
                'phone_number' => $data['billing_phone_number'],
            ]);

            if($shippingCount > 0){
                Delivery_address::where('user_id', $user_id)->update([
                'name' => $data['shipping_name'],
                'country' => $data['shipping_country'],
                'city' => $data['shipping_city'],
                'state' => $data['shipping_state'],
                'address' => $data['shipping_address'],
                'phone_number' => $data['shipping_phone_number'],
                ]);
            }else{
                $shipping = new Delivery_address;

                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->phone_number = $data['shipping_phone_number'];

                $shipping->save();
            }
            return redirect( route('orderReview'));
        }
        return view('user.inc.product.checkout', compact('userDetail', 'countries', 'shippingDetail'));
    }

    public function oderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetail = User::where('id', $user_id)->first();
        $shippingDetail = Delivery_address::where('user_id', $user_id)->first();
        $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();

        foreach($userCart as $key => $product)
        {
            $productDetail = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetail->image;
        }
        return view('user.inc.product.order_review', compact('userDetail', 'shippingDetail', 'userCart'));
    }

    public function placeOrder(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetail = Delivery_address::where('user_id', $user_id)->first();

        if(empty(Session::get('CouponCode'))){
            $couponCode = '';
        }else{
            $couponCode = Session::get('CouponCode');
        }

        if(empty(Session::get('CouponAmount'))){
            $couponAmount = '';
        }else{
            $couponAmount = Session::get('CouponAmount');
        }
        

        $order = new Order;
        $order->user_id = $user_id; 
        $order->user_email = $user_email;
        $order->name = $shippingDetail->name;
        $order->address = $shippingDetail->address;
        $order->city = $shippingDetail->city;
        $order->state = $shippingDetail->state;
        $order->country = $shippingDetail->country;
        $order->phone_number = $shippingDetail->phone_number;
        $order->coupon_code = $couponCode;
        $order->coupon_amount = $couponAmount;
        $order->status = "New";
        $order->payment_method = $data['payment_method'];
        $order->grand_total = $data['grand_total'];
        $order->save(); 
        
        $order_id = DB::getPdo()->lastInsertId();

        $cartProducts = DB::table('carts')->where('user_email', $user_email)->get();

        foreach($cartProducts as $Product)
        {
            $cartProduct = new OrderProduct;
            $cartProduct->order_id = $order_id;
            $cartProduct->user_id = $user_id;
            $cartProduct->product_id = $Product->product_id;
            $cartProduct->product_code = $Product->product_code;
            $cartProduct->product_name = $Product->product_name;
            $cartProduct->product_size = $Product->size;
            $cartProduct->product_color = $Product->product_color;
            $cartProduct->price = $Product->price;
            $cartProduct->product_quantity = $Product->quantity;
            $cartProduct->save();
        }

        Session::put('order_id', $order_id);
        Session::put('grand_total', $data['grand_total']);
        
        return redirect( route('thanksPage'));
    }

    public function thanks(){
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email', $user_email)->delete();
        return view('user.inc.product.thanks');
    }

    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        // dd($orders);
        return view('user.inc.order.orders', compact('orders'));
    }

    public function userOrderDetail($order_id)
    {
        $user_id = Auth::user()->id;
        $orderDetail = Order::with('orders')->where('id', $order_id)->first();

        return view('user.inc.order.orderDetail', compact('orders'));
    }
}
