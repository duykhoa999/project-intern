@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật loại rượu
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
                    <form role="form" action="{{route('admin.category.update', ['id' => $edit_category->ma_lr])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã loại rượu</label>
                            <input disabled type="text" value="{{$edit_category->ma_lr}}" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control " placeholder="Mã loại rượu" required>
                            @if ($errors->has('ma_lr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_lr')}}</span>
                            @endif
                            <input type="hidden" value="{{$edit_category->ma_lr}}" name="ma_lr" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên loại rượu</label>
                            <input type="text" value="{{$edit_category->ten_lr}}" onkeyup="ChangeToSlug();" name="ten_lr" class="form-control" id="slug">
                            @if ($errors->has('ten_lr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ten_lr')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$edit_category->slug}}" name="slug" class="form-control" id="convert_slug">
                            @if ($errors->has('slug'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('slug')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_category" class="btn btn-info">Cập nhật</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.category.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
