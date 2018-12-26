@extends('user.app')

@section('content')
    <section id="cart_items"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Billing Detail</h2>
                        <div class="form-group">
                            <p class="form-control">Name: @if(!empty($userDetail->name)) {{ $userDetail->name }} @endif</p>
                            <p class="form-control">Country: @if(!empty($userDetail->country)) {{ $userDetail->country }} @endif</p>
                            <p class="form-control">City: @if(!empty($userDetail->city)) {{ $userDetail->city }} @endif</p>
                            <p class="form-control">State: @if(!empty($userDetail->state)) {{ $userDetail->state }} @endif</p>
                            <p class="form-control">Address: @if(!empty($userDetail->address)) {{ $userDetail->address }} @endif</p>
                            <p class="form-control">Phone Number: @if(!empty($userDetail->phone_number)) {{ $userDetail->phone_number }} @endif</p>
                        </div>

                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Shiping Detail</h2>
                        <div class="form-group">
                            <p class="form-control">Name: @if(!empty($shippingDetail->name)) {{ $shippingDetail->name }} @endif</p>
                            <p class="form-control">Country: @if(!empty($shippingDetail->country)) {{ $shippingDetail->country }} @endif</p>
                            <p class="form-control">City: @if(!empty($shippingDetail->city)) {{ $shippingDetail->city }} @endif</p>
                            <p class="form-control">State: @if(!empty($shippingDetail->state)) {{ $shippingDetail->state }} @endif</p>
                            <p class="form-control">Address: @if(!empty($shippingDetail->address)) {{ $shippingDetail->address }} @endif</p>
                            <p class="form-control">Phone Number: @if(!empty($shippingDetail->phone_number)) {{ $shippingDetail->phone_number }} @endif</p>
                        </div>
                    </div><!--/sign up form-->
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>
    
            <div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản phẩm</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userCart as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img style="width:100px;" src="{{ asset('images/admin/product/small/'.$cart->image)}}"alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $cart->product_name }}</a></h4>
								<p>Size: {{ $cart->size }}</p>
							</td>
							<td class="cart_price">
								<p>${{ $cart->price }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
									@if($cart->quantity > 1)
									<a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
									@endif
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ $cart->price*$cart->quantity }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ route('removeCartProduct', $cart->id) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                        @endforeach
                        <tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$ {{ $total_amount }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Disscount Amont</td>
										<td>@if(!empty(Session::get('CouponAmount'))) $ {{ Session::get('CouponAmount') }} @else $ 0 @endif</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>$ {{ $grand_total = $total_amount - Session::get('CouponAmount')}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
            </div>
            <form name="paymentForm" id="paymentForm" action="{{ route('placeOrder')}}" method="POST"> {{ csrf_field() }}
                <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                <div class="payment-options">
                    <span>
                        <label><h4>Select Payment Method:</h4></label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" id="COD" value="COD"><b> COD</b></label>
                    </span>
                    <span>
                        <label><label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><b> Paypal</b></label>
                    </span>
                    <span style="float:right;">
                        <button type="submit" class="btn btn-success" onclick="return selectPaymentMethod();">Place Order</button>
                    </span>
                </div>
            </form>
            </div>
        </div>
    </section><!--/form-->
    @endsection 