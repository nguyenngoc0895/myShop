
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a><a href="{{ route('order.index')}}" class="current">Index order</a> </div>
            <h4 class="text-center">Customer name Ordered : {{ $orderDetail->name}}</h4>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Order Detail</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Order Date</td>
                                        <td class="taskStatus">{{ $orderDetail->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Order Status</td>
                                        <td class="taskStatus">{{ $orderDetail->status}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Billing Address</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Name</td>
                                        <td class="taskStatus">{{ $userDetail->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Address</td>
                                        <td class="taskStatus">{{ $userDetail->address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>City</td>
                                        <td class="taskStatus">{{ $userDetail->city}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>State</td>
                                        <td class="taskStatus">{{ $userDetail->state}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Country</td>
                                        <td class="taskStatus">{{ $userDetail->country}}</td>
                                    </tr>                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Billing Address</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="{{ route('order.updateStatus')}}" method="POST" class="form-horizontal"> {{ csrf_field()}}
                                <input type="hidden" name="order_id" value="{{ $orderDetial->id }}">
                                <div class="control-group">
                                    <label class="control-label">Select Order Status</label>
                                    <div class="controls">
                                        <select name="order_status" id="order_status" required="">
                                            <option value="New">New</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="In_process">In Process</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Customer Detail</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Name</td>
                                        <td class="taskStatus">{{ $orderDetail->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Email</td>
                                        <td class="taskStatus">{{ $orderDetail->user_email}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Phone number</td>
                                        <td class="taskStatus">{{ $orderDetail->phone_number}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                    <div class="widget-box collapsible" >
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Shipping Address</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Name</td>
                                        <td class="taskStatus">{{ $orderDetail->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Address</td>
                                        <td class="taskStatus">{{ $orderDetail->address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>City</td>
                                        <td class="taskStatus">{{ $orderDetail->city}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>State</td>
                                        <td class="taskStatus">{{ $orderDetail->state}}</td>
                                    </tr>
                                    <tr>
                                        <td class="taskDesc"><i class="icon-info-sign"></i>Country</td>
                                        <td class="taskStatus">{{ $orderDetail->country}}</td>
                                    </tr>                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="span11">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Product</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderDetail->orders as $product)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_size }}</td>
                                        <td>{{ $product->product_color }}</td>
                                        <td>$ {{ $product->price }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/admin/jquery.validate.js')}}"></script>
@endsection