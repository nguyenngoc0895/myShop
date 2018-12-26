<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orders')->orderBy('id', 'DESC')->get();
        return view('admin.inc.order.index', compact('orders'));
    }

    public function view($order_id)
    {
        $orderDetail = Order::with('orders')->where('id', $order_id)->first();
        $user_id = $orderDetail->user_id;
        $userDetail = User::where('id', $user_id)->first();

        return view('admin.inc.order.view', compact('orderDetail', 'userDetail'));    
    }

    public function updateOrderStatus(Request $request)
    {
        $data = $request->all();
        
    }
}
