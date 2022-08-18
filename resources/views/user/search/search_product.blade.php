@extends('master')
@section('content')
<!-- *********************** Start Banner ***************** -->
<div class="banner" style="background: white;">
    <div class="house owl-carousel owl-theme container" id="banner-slider">
        <div class="item">
            <img src="{{URL::to('frontend/img/banner_1.jpg')}}" alt="">
        </div>
        <div class="item">
            <img src="{{URL::to('frontend/img/banner_2.jpg')}}" alt="">
        </div>
        <div class="item">
            <img src="{{URL::to('frontend/img/banner_3.jpg')}}" alt="">
        </div>
    </div>
</div>
<!-- *********************** End Banner ***************** -->
<section>
    <div class="category-list" style="background: white;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="category">
                        <div class="category-title">
                            <h2>Kết Quả Tìm Kiếm</h2>
                        </div>
                        <div class="category-section">
                            <div class="row">
                                @foreach($search_product as $key=> $product)
                                <input type="hidden" value="{{$product->ma_dr}}" class="cart_product_id_{{$product->ma_dr}}">

                                <input type="hidden" id="wishlist_productname{{$product->ma_dr}}" value="{{$product->ten_dr}}" class="cart_product_name_{{$product->ma_dr}}">

                                <input type="hidden" value="{{$product->sl_ton}}" class="cart_product_quantity_{{$product->ma_dr}}">

                                <input type="hidden" value="{{$product->hinh_anh}}" class="cart_product_image_{{$product->ma_dr}}">

                                <input type="hidden" id="wishlist_productprice{{$product->ma_dr}}" value="{{number_format($product->gia,0,',','.')}}VNĐ">

                                <input type="hidden" value="{{$product->gia}}" class="cart_product_price_{{$product->ma_dr}}">

                                <input type="hidden" value="1" class="cart_product_qty_{{$product->ma_dr}}">
                                <div class="item-category col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
                                    @if($product->sl_ton == 0)
                                    <div class="error">
                                        <p class="error-one">HẾT HÀNG</p>
                                    </div>
                                    @endif
                                    <div class="images-products">
                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->ma_dr)}}">
                                            <img class="image-one" src="{{URL::to('uploads/product/'.$product->hinh_anh)}}" alt="">
                                            <img class="image-two" src="{{URL::to('uploads/product/'.$product->hinh_anh)}}" alt="">
                                        </a>
                                        <div class="love">
                                            <div class="love-one">
                                                <i class="far fa-heart"></i>
                                            </div>
                                        </div>
                                        <div class="views">
                                            <div class="views-one">
                                                <i class="far fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-products">
                                        <h3><a href="">{{$product->ten_dr}}</a></h3>
                                        <!-- <p> Mã số: 0020234</p> -->
                                        <div class="price-item">
                                            <span class="price">{{number_format($product->gia).' VNĐ'}}</span>
                                            <!-- <span class="price-discount">195,000đ </span> -->
                                        </div>

                                        <div class="addtocart">
                                            <div class="shopping">
                                                <button type="button" data-id_product="{{$product->ma_dr}}" name="add-to-cart" class="btn add-to-cart"> <i class="fas fa-shopping-cart"></i> ADD TO
                                                    CART</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                {!!$search_product->links()!!}
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
