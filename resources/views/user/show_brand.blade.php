@extends('master')
@section('content')
    <!-- *********************** Start Banner ***************** -->
    <div class="banner" style="background: white;">
        <div class="house owl-carousel owl-theme container" id="banner-slider">
            <div class="item">
                <img src="{{ URL::to('frontend/img/banner_1.jpg') }}" alt="">
                <!-- <div class="item-content">
                    <span>Giảm giá mùa hè!</span>
                    <h2 style="color: white;">Máy Chạy Bộ Điện Đa Năng
                        <br style="color: white;"> Phong Cách Đơn Giản
                    </h2>
                    <p style="color: white;">Giảm Giá Lớn</p>
                    <h3 style="color: white;">Sale 30% Off</h3>
                    <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{ URL::to('/chi-tiet-san-pham/31') }}">Mua Ngay</a></button>
                </div> -->
            </div>
            <div class="item">
                <img src="{{ URL::to('frontend/img/banner_2.jpg') }}" alt="">
                <!-- <div class="item-content">
                    <span style="color: white;">Đừng Bỏ Lỡ!</span>
                    <h2 style="color: white;">Ghế Tập Bụng Đa Năng
                    </h2>
                    <p style="color: white;">Thiết Bị Tập Gym</p>
                    <h3 style="color: white;">Giá chỉ 1,450,000</h3>
                    <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{ URL::to('/chi-tiet-san-pham/42') }}">Mua Ngay</a></button>
                </div> -->
            </div>
            <div class="item">
                <img src="{{ URL::to('frontend/img/banner_3.jpg') }}" alt="">
                <!-- <div class="item-content">
                    <span style="color: white;">Áo Ngắn Tay Nam</span>
                    <h2 style="color: white;">Kiểu dáng thời trang
                        <br style="color: white;"> Đẳng cấp 4 mùa
                    </h2>
                    <p style="color: white;">Sản phẩm mới</p>
                    <h3 style="color: white;">Giảm giá 15%</h3>
                    <button class="shopnow"> <a style="color: white; text-decoration: none;" href="{{ URL::to('/chi-tiet-san-pham/45') }}">Mua Ngay</a></button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- *********************** End Banner ***************** -->
    <section>
        <div class="shop-section">
            <div class="container">
                <div class="row">
                    <div class="services" style="flex-wrap: wrap;">
                        <div class="services-item boder-right col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="fas fa-truck"></i></a>
                            <div class="services-text">
                                <h5>Giao Hàng Miễn Phí</h5>
                                <p>Tất Cả Đơn Hàng</p>
                            </div>
                        </div>
                        <div class="services-item boder-right col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="far fa-credit-card"></i></a>
                            <div class="services-text">
                                <h5>Thanh Toán An Toàn</h5>
                                <p>An toàn 100%</p>
                            </div>
                        </div>
                        <div class="services-item boder-right col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="far fa-comment-alt"></i></a>
                            <div class="services-text">
                                <h5>Hỗ Trợ 24/7</h5>
                                <p>Hỗ trợ trực tuyến</p>
                            </div>
                        </div>
                        <div class="services-item col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <a href=""><i class="fas fa-wallet"></i></a>
                            <div class="services-text">
                                <h5>Bảo Hành 24 Ngày</h5>
                                <p>Lỗi từ nhà sản xuất</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-list" style="background: white;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="category">
                            <div class="category-title">
                                <h2 style="color: black;">{{ $brand_name->ten_th }}</h2>
                            </div>
                            <div class="category-section">
                                <div class="row">
                                    @foreach ($show_brand_id as $key => $product)
                                        <input type="hidden" value="{{ $product->ma_dr }}"
                                            class="cart_product_id_{{ $product->ma_dr }}">

                                        <input type="hidden" id="wishlist_productname{{ $product->ma_dr }}"
                                            value="{{ $product->ten_dr }}"
                                            class="cart_product_name_{{ $product->ma_dr }}">

                                        <input type="hidden" value="{{ $product->sl_ton }}"
                                            class="cart_product_quantity_{{ $product->ma_dr }}">

                                        <input type="hidden" value="{{ $product->hinh_anh }}"
                                            class="cart_product_image_{{ $product->ma_dr }}">

                                        @if (isset($product->coupon_details) && $product->coupon_details->phantram_km > 0  && $product->coupon_details->so_luong > 0)
                                            <input type="hidden" id="wishlist_productprice{{ $product->ma_dr }}"
                                                value="number_format($product->gia - (($product->gia * $product->coupon_details->phantram_km) /100))VNĐ">

                                            <input type="hidden"
                                                value="{{ $product->gia - ($product->gia * $product->coupon_details->phantram_km) / 100 }}"
                                                class="cart_product_price_{{ $product->ma_dr }}">
                                        @else
                                            <input type="hidden" id="wishlist_productprice{{ $product->ma_dr }}"
                                                value="{{ number_format($product->gia) }}VNĐ">

                                            <input type="hidden" value="{{ $product->gia }}"
                                                class="cart_product_price_{{ $product->ma_dr }}">
                                        @endif
                                        <input type="hidden" value="1"
                                            class="cart_product_qty_{{ $product->ma_dr }}">
                                        <div class="item-category col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
                                            @if ($product->sl_ton == 0)
                                                <div class="error">
                                                    <p class="error-one">HẾT HÀNG</p>
                                                </div>
                                            @endif
                                            <div class="images-products">
                                                <a href="{{ route('show-detail-product', ['id' => $product->ma_dr]) }}">
                                                    <img class="image-one"
                                                        src="{{ URL::to('uploads/product/' . $product->hinh_anh) }}"
                                                        alt="">
                                                    <img class="image-two"
                                                        src="{{ URL::to('uploads/product/' . $product->hinh_anh) }}"
                                                        alt="">
                                                </a>

                                            </div>
                                            <div class="text-products">
                                                <h3><a
                                                        href="{{ route('show-detail-product', ['id' => $product->ma_dr]) }}">{{ $product->ten_dr }}</a>
                                                </h3>
                                                <!-- <p> Mã số: 0020234</p> -->
                                                <div class="price-item">
                                                    @if (isset($product->coupon_details) &&
                                                        $product->coupon_details->phantram_km > 0 &&
                                                        $product->coupon_details->so_luong > 0)
                                                        <span
                                                            class="price">{{ number_format($product->gia - ($product->gia * $product->coupon_details->phantram_km) / 100) }}
                                                            VNĐ</span>
                                                        <span class="price-discount">{{ number_format($product->gia) }}
                                                            VNĐ</span>
                                                    @else
                                                        <span
                                                            class="price">{{ number_format($product->gia) . ' VNĐ' }}</span>
                                                    @endif
                                                </div>

                                                <div class="addtocart">
                                                    <div class="shopping">
                                                        <?php
                                                        $user = Session::get('user');
                                                        $check = 1;
                                                        if ($user === null) {
                                                            $check = 0;
                                                        }
                                                        ?>
                                                        <button type="button" data-check="{{ $check }}"
                                                            data-id_product="{{ $product->ma_dr }}" name="add-to-cart"
                                                            class="btn add-to-cart"> <i class="fas fa-shopping-cart"></i>
                                                            ADD TO
                                                            CART</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
