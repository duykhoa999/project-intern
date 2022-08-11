@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm dòng rượu
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
                    <form role="form" action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã dòng rượu</label>
                            <input type="text" maxlength="10" name="ma_dr" value="{{old('ma_dr')}}" class="form-control " placeholder="Mã dòng rượu" required>
                            @if ($errors->has('ma_dr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_dr')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên dòng rượu</label>
                            <input type="text" data-validation="length" value="{{old('ten_dr')}}" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="ten_dr" class="form-control " id="slug" placeholder="Tên dòng rượu" onkeyup="ChangeToSlug();">
                            @if ($errors->has('ten_dr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ten_dr')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number" data-validation="number" value="{{old('sl_ton')}}" data-validation-error-msg="Làm ơn điền số lượng" name="sl_ton" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                            @if ($errors->has('sl_ton'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('sl_ton')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{old('slug')}}" id="convert_slug" placeholder="">
                            @if ($errors->has('slug'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('slug')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá bán</label>
                            <input type="number" data-validation="length" value="{{old('gia')}}" data-validation-length="min5" data-validation-error-msg="Làm ơn điền số tiền" name="gia" class="form-control price_format" id="gia" placeholder="Điền giá sản phẩm">
                            @if ($errors->has('gia'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('gia')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="hinh_anh" class="form-control" id="exampleInputEmail1">
                            @if ($errors->has('hinh_anh'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('hinh_anh')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="mo_ta" id="ckeditor1" placeholder="Mô tả sản phẩm">{{old('mo_ta')}}</textarea>
                            @if ($errors->has('mo_ta'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('mo_ta')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="noi_dung" id="id4" placeholder="Nội dung sản phẩm">{{old('noi_dung')}}</textarea>
                            @if ($errors->has('noi_dung'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('noi_dung')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loại rượu</label>
                            <select name="ma_lr" class="form-control input-sm m-bot15">
                            @foreach($cate_product as $key_cate => $cate)
                            <option value="{{$cate->ma_lr}}" {{ old('ma_lr') == $cate->ma_lr ? 'selected' : '' }}>{{$cate->ten_lr}}
                            </option>
                             @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="ma_th" class="form-control input-sm m-bot15">
                            @foreach($brand_product as $key_brand => $brand)
                                <option value="{{$brand->ma_th}}" {{ old('ma_th') == $brand->ma_th ? 'selected' : '' }}>{{$brand->ten_th}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhà cung cấp</label>
                            <select name="ma_ncc" class="form-control input-sm m-bot15">
                            @foreach($manufacture_product as $key_manu => $manu)
                                <option value="{{$manu->ma_ncc}}" {{ old('ma_ncc') == $manu->ma_ncc ? 'selected' : '' }}>{{$manu->ten_ncc}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.product.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
