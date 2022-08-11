@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật dòng rượu
            </header>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{route('admin.product.update', ['id' => $product->ma_dr])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã dòng rượu</label>
                            <input disabled type="text" value="{{$product->ma_dr}}" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control " placeholder="Mã nhà cung cấp" required>
                            @if ($errors->has('ma_dr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_dr')}}</span>
                            @endif
                            <input type="hidden" value="{{$product->ma_dr}}" name="ma_dr" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên dòng rượu</label>
                            <input type="text" name="ten_dr" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{$product->ten_dr ?? old('ten_dr')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number" data-validation="sl_ton" data-validation-error-msg="Làm ơn điền số lượng" name="sl_ton" class="form-control" id="convert_slug" value="{{$product->sl_ton ?? old('sl_ton')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug" class="form-control" id="exampleInputEmail1" value="{{$product->slug ?? old('slug')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá bán</label>
                            <input type="number" value="{{$product->gia ?? old('gia')}}" name="gia" class="form-control price_format" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="hinh_anh" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('uploads/product/'.$product->hinh_anh)}}" height="100" width="100">
                        </div>
                        <style type="text/css">
                            p.cofile {
                                text-align: left;
                                font-size: 16px;
                                margin: 5px 0;
                            }
                        </style>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="mo_ta" id="ckeditor2">{{$product->mo_ta ?? old('mo_ta')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="noi_dung" id="ckeditor3">{{$product->noi_dung_dr ?? old('noi_dung')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loại rượu</label>
                            <select name="ma_lr" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    @if($cate->ma_lr==$product->loai_ruou->ma_lr)
                                    <option selected value="{{$cate->ma_lr}}">{{$cate->ten_lr}}</option>
                                    @else
                                    <option value="{{$cate->ma_lr}}">{{$cate->ten_lr}}</option>
                                    @endif
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="ma_th" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)
                                @if($brand->ma_th==$product->thuong_hieu->ma_th)
                                <option selected value="{{$brand->ma_th}}">{{$brand->ten_th}}</option>
                                @else
                                <option value="{{$brand->ma_th}}">{{$brand->ten_th}}</option>
                                @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhà cung cấp</label>
                            <select name="ma_ncc" class="form-control input-sm m-bot15">
                                @foreach($manufacture_product as $key => $manu)
                                @if($manu->ma_ncc==$product->nha_cc->ma_ncc)
                                <option selected value="{{$manu->ma_ncc}}">{{$manu->ten_ncc}}</option>
                                @else
                                <option value="{{$manu->ma_ncc}}">{{$manu->ten_ncc}}</option>
                                @endif
                                @endforeach

                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.product.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
