@extends('user.app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            @if(Session::has('message_error'))
            <div class="alert alert-error alert-block" style="background-color:#d7efe5">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('message_error') !!}</strong>
            </div>
            @endif
            <div class="col-sm-12 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-4">
                        <div class="view-product">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                <a href="{{ asset('/images/admin/product/large/'.$productDetail->image) }}">
                                    <img id="mainImage" style="width:350px; height: 400px;" src="{{ asset('/images/admin/product/medium/'.$productDetail->image) }}" alt="" />
                                </a>
                            </div>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active thumbnails">
                                    @foreach($productAltImages as $altImage)
                                    <a href="{{ asset('images/admin/product/medium/'.$altImage->image) }}" data-standard="{{ asset('images/admin/product/small/'.$altImage->image) }}">
                                        <img class="changeImage" style="width:70px; cursor:pointer" src="{{ asset('images/admin/product/small/'.$altImage->image) }}" alt="">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <form name="addtocartForm" id="addtocartForm" action="{{ route('addCart') }}" method="POST" >{{ csrf_field()}}

                            <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
                            <input type="hidden" name="product_name" value="{{ $productDetail->product_name }}">
                            <input type="hidden" name="product_code" value="{{ $productDetail->product_code }}">
                            <input type="hidden" name="product_color" value="{{ $productDetail->product_color }}">
                            <input type="hidden" name="price" id="price" value="{{ $productDetail->price }}">

                            <div class="product-information"><!--/product-information-->
                                <img src="{{ asset('images/user/product-details/new.jpg')}}" class="newarrival" alt="" />
                                <h2>{{ $productDetail->product_name }}</h2>
                                <p>Mã hàng: {{ $productDetail->product_code }}</p>
                                <p> 
                                    <select id="selectSize" name="size" style="width:150px;">
                                        <option value="" >Chọn kích cỡ</option>
                                        @foreach($productDetail->attributes as $sizes)
                                        <option value="{{ $productDetail->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <span>
                                    <span id="getPrice">Giá: {{ $productDetail->price }} $</span>
                                    <label>Quantity:</label>
                                    <input type="text" name="quantity" value="1" />
                                    @if($totalStock > 0)
                                    <button type="submit" id="cartButton" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Thêm vào giỏ hàng
                                    </button>
                                    @endif
                                </span>
                                <p><b>Tình trạng:</b> <span id="Availability">@if($totalStock > 0) Còn hàng @else Hết hàng @endif</span></p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> E-SHOPPER</p>
                                <img src="{{ asset('images/user/product-details/rating.png')}}" alt="" />
                                <a href=""><img src="{{ asset('images/user/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </form>
                    </div>
                </div><!--/product-details-->
                
                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#description" data-toggle="tab">Chi tiết về sản phẩm</a></li>
                            <li><a href="#care" data-toggle="tab">Mô tả sản phẩm</a></li>
                            <li><a href="#delivery" data-toggle="tab">Giao hàng</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="description" >
                            <div class="col-sm-12">
                                <p>{{ $productDetail->description }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="care" >
                            <div class="col-sm-12">
                                <p>{{ $productDetail->care }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="delivery" >
                            <div class="col-sm-12">
                                <p>Giao hàng nhanh <br>
									tùy chọn này sẽ được code sau ok?</p>
                            </div>
                        </div>
                    </div>
                </div><!--/category-tab-->


                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Sản Phẩm Liên quan</h2>
                    
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count=1; ?>
                            @foreach($relatedProducts->chunk(3) as $chunk)
                            <div <?php if($count == 1){ ?> class="item active" <?php } else { ?> class="item" <?php } ?>>	
                                @foreach($chunk as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="width:250px;" src="{{ asset('images/admin/product/small/'.$item->image) }}" alt="" />
                                                <h2>{{ $item->price }} $</h2>
                                                <p>{{ $item->product_name }}</p>
                                                <a href="{{ url('/'.$item->product_name.'/'.$item->id)}}"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->
                
            </div>
        </div>
    </div>
</section> 
@endsection 