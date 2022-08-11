@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thương hiệu
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
                    <form role="form" action="{{route('admin.trademark.update', ['id' => $edit_trademark->ma_th])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã thương hiệu</label>
                            <input disabled type="text" value="{{$edit_trademark->ma_th}}" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control " placeholder="Mã nhà cung cấp" required>
                            @if ($errors->has('ma_th'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_th')}}</span>
                            @endif
                            <input type="hidden" value="{{$edit_trademark->ma_th}}" name="ma_th" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{$edit_trademark->ten_th ?? old('ten_th')}}" onkeyup="ChangeToSlug();" name="ten_th" class="form-control" id="slug">
                            @if ($errors->has('ten_th'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ten_th')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="hinh_anh" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('uploads/type/'.$edit_trademark->hinh_anh)}}" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$edit_trademark->slug ?? old('slug')}}" name="slug" class="form-control" id="convert_slug">
                            @if ($errors->has('slug'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('slug')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả </label>
                            <textarea style="resize: none" rows="8" class="form-control" name="mo_ta" id="ckeditor1">{{$edit_trademark->mo_ta ?? old('mo_ta')}}</textarea>
                            @if ($errors->has('mo_ta'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('mo_ta')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật thương hiệu</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.trademark.index')}}')">Hủy</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
    @endsection
