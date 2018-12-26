<?php

namespace App\Http\Controllers\Admin;

use App\Model\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = $data['status'];
            $coupon->save();

            return redirect( route('Coupon.index'))->with('message_success', 'Coupon has been added successfully');
        }
        return view('admin.inc.coupons.create');
    }

    public function index()
    {
        $coupons = Coupon::get();;
        return view('admin.inc.coupons.index', compact('coupons'));
    }

    public function edit(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $coupon = Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];	
			$coupon->amount_type = $data['amount_type'];	
			$coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            
			if(empty($data['status'])){
				$data['status'] = 0;
            }
            
			$coupon->status = $data['status'];
            $coupon->save();
            
            return redirect( route('Coupon.index'))->with('message_success', 'Coupon has been updated successfully');
        }

        $couponDetail = Coupon::find($id);

        return view('admin.inc.coupons.edit', compact('couponDetail'));
    }

    public function delete($id)
    {
        Coupon::where('id', $id)->delete();
        return redirect()->back()->with('message_success', 'Coupon has been deleted successfully');
    }
}
