@extends('user.app')

@section('content')
    <section id="cart_items"><!--form-->
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Ordered Product</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Created on</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            @foreach($order->orders as $product)
                            {{ $product->product_code }}
                            @endforeach
                        </td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->grand_total }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td> view detail</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section><!--/form-->
    @endsection 