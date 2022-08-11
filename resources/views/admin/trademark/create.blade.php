@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu
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
                    <form role="form" action="{{route('admin.trademark.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã thương hiệu</label>
                            <input type="text" maxlength="10" value="{{old('ma_th')}}" name="ma_th" class="form-control " placeholder="Mã thương hiệu" required>
                            @if ($errors->has('ma_th'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_th')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="ten_th" value="{{old('ten_th')}}" class="form-control" placeholder="Tên thương hiệu" required onkeyup="ChangeToSlug();" id="slug">
                            @if ($errors->has('ten_th'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ten_th')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="hinh_anh" value="{{old('hinh_anh')}}" class="form-control" id="exampleInputEmail1">
                            @if ($errors->has('hinh_anh'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('hinh_anh')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{old('slug')}}" id="convert_slug">
                            @if ($errors->has('slug'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('slug')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="mo_ta" id="ckeditor1" placeholder="Mô tả thương hiệu">{{old('hinh_anh')}}</textarea>
                            @if ($errors->has('mo_ta'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('mo_ta')}}</span>
                            @endif
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm thương hiệu</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.trademark.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
